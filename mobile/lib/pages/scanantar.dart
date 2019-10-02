import 'package:flutter/material.dart';
import 'package:barcode_scan/barcode_scan.dart';
import 'package:mobile/model/util.dart';
import 'package:mobile/model/mhspengantar.dart';
import 'package:mobile/model/baseurl.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:simple_permissions/simple_permissions.dart';
import 'dart:async';
import 'package:flutter/services.dart';

class ScanAntar extends StatefulWidget {
  @override
  _ScanAntarState createState() => _ScanAntarState();
}

class _ScanAntarState extends State<ScanAntar>
    with SingleTickerProviderStateMixin {
  // int cek1 = Util.cek1;
  // int cek2 = Util.cek2;
  // int cek3 = Util.cek3;
  // int cek4 = Util.cek4;
  // int cek5 = Util.cek5;
  // int cek6 = Util.cek6;
  // int cek7 = Util.cek7;
  // int cek8 = Util.cek8;
  // int cek9 = Util.cek9;
  // int cek10 = Util.cek10;
  // int cek11 = Util.cek11;
  // int cek12 = Util.cek12;
  // int cek13 = Util.cek13;
  // int cek14 = Util.cek14;
  // int cek15 = Util.cek15;
  // int cek16 = Util.cek16;

  String pertemuanJson =
      '{"menuAbsen":[{"pertemuan":"1","per":"satu"},{"pertemuan":"2","per":"dua"},{"pertemuan":"3","per":"tiga"},{"pertemuan":"4","per":"empat"},{"pertemuan":"5","per":"lima"},{"pertemuan":"6","per":"enam"},{"pertemuan":"7","per":"tujuh"},{"pertemuan":"8","per":"delapan"},{"pertemuan":"9","per":"sembilan"},{"pertemuan":"10","per":"sepuluh"},{"pertemuan":"11","per":"sebelas"},{"pertemuan":"12","per":"dua_belas"},{"pertemuan":"13","per":"tiga_belas"},{"pertemuan":"14","per":"empat_belas"},{"pertemuan":"15","per":"lima_belas"},{"pertemuan":"16","per":"enam_belas"}]}';
  final ScrollController _scrollController = ScrollController();
  List<dynamic> pertemuan;
  // variabel animasi floatbutton
  bool isOpened = false;
  AnimationController _animationController;
  Animation<Color> _buttonColor;
  Animation<double> _animateIcon;
  Animation<double> _translateButton;
  Curve _curve = Curves.easeOut;
  double _fabHeight = 56.0;

  // variabel animasi loading
  var loading = false;
  var notfound = false;
  final listmhs = new List<MhsPengantar>();
  final GlobalKey<RefreshIndicatorState> _refresh =
      new GlobalKey<RefreshIndicatorState>();

  Future<void> _tampilmhs() async {
    listmhs.clear();
    setState(() {
      loading = true;
      notfound = false;
    });
    final response = await http.post(Baseurl.mhspengantar,
        body: {"nama_mata_kuliah": Util.mk, "kelas": Util.kelasantar});
    if (response.contentLength == 2) {
      setState(() {
        loading = false;
        notfound = true;
      });
    } else {
      final data = jsonDecode(response.body);
      data.forEach((api) {
        final ok = new MhsPengantar(
            api['nim'], api['nama'], api['persentase'], api['foto']);
        listmhs.add(ok);
      });
      setState(() {
        loading = false;
        notfound = false;
      });
    }
  }

  _cekpertemuan() async {
    final responsecek = await http.post(Baseurl.cekpertemuan,
        body: {"nama_mata_kuliah": Util.mk, "kelas": Util.kelasantar});
    var datacek = jsonDecode(responsecek.body);
    setState(() {
      Util.cek1 = datacek['cek1'];
      Util.cek2 = datacek['cek2'];
      Util.cek3 = datacek['cek3'];
      Util.cek4 = datacek['cek4'];
      Util.cek5 = datacek['cek5'];
      Util.cek6 = datacek['cek6'];
      Util.cek7 = datacek['cek7'];
      Util.cek8 = datacek['cek8'];
      Util.cek9 = datacek['cek9'];
      Util.cek10 = datacek['cek10'];
      Util.cek11 = datacek['cek11'];
      Util.cek12 = datacek['cek12'];
      Util.cek13 = datacek['cek13'];
      Util.cek14 = datacek['cek14'];
      Util.cek15 = datacek['cek15'];
      Util.cek16 = datacek['cek16'];
    });
  }

  @override
  void initState() {
    _cekpertemuan();
    _tampilmhs();
    Map<String, dynamic> decodedPertemuan = json.decode(pertemuanJson);
    pertemuan = decodedPertemuan['menuAbsen'];
    _animationController =
        AnimationController(vsync: this, duration: Duration(milliseconds: 500))
          ..addListener(() {
            setState(() {});
          });
    _animateIcon =
        Tween<double>(begin: 0.0, end: 1.0).animate(_animationController);
    _buttonColor = ColorTween(
      begin: Colors.blue,
      end: Colors.red,
    ).animate(CurvedAnimation(
      parent: _animationController,
      curve: Interval(
        0.00,
        1.00,
        curve: Curves.linear,
      ),
    ));
    _translateButton = Tween<double>(
      begin: _fabHeight,
      end: -14.0,
    ).animate(CurvedAnimation(
      parent: _animationController,
      curve: Interval(
        0.0,
        0.75,
        curve: _curve,
      ),
    ));
    super.initState();
  }

  @override
  dispose() {
    _animationController.dispose();
    super.dispose();
  }

  animate() {
    if (!isOpened) {
      _animationController.forward();
    } else {
      _animationController.reverse();
    }
    isOpened = !isOpened;
  }

  Widget camera() {
    return Container(
      child: FloatingActionButton(
        heroTag: "btnScan",
        onPressed: () {
          showDialog(
            context: context,
            builder: (BuildContext context) {
              return AlertDialog(
                // title: new Text("Login"),
                content: new Container(
                  child: CustomScrollView(
                    controller: _scrollController,
                    slivers: <Widget>[
                      SliverGrid(
                        gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                          crossAxisCount: 2,
                          childAspectRatio: 1,
                        ),
                        delegate: SliverChildBuilderDelegate(
                          (BuildContext context, int index) {
                            Map<String, String> temu =
                                pertemuan[index].cast<String, String>();
                            Future<void> absendata() async {
                              final response =
                                  await http.post(Baseurl.absenmi, body: {
                                'nim': Util.nim,
                                'ab': Util.ab,
                                'per': Util.pert,
                                'mk': Util.mk,
                                'kls': Util.kelasantar
                              });
                              print(Util.ab);
                              print(Util.nim);
                              var dataup = json.decode(response.body);
                              // print(dataup['pesan']);
                              // print(Util.pert);

                              String imes = dataup['pesan'];
                              showDialog(
                                context: context,
                                builder: (BuildContext context) {
                                  return AlertDialog(
                                    title: new Text("Message"),
                                    content: new Text(imes),
                                    actions: <Widget>[
                                      new FlatButton(
                                        child: new Text("Close"),
                                        onPressed: () {
                                          _cekpertemuan();
                                          _tampilmhs();
                                          Navigator.of(context).pop();
                                        },
                                      ),
                                    ],
                                  );
                                },
                              );
                            }

                            void update(String _barcodeString) async {
                              final res = await http
                                  .post(Baseurl.updateabsenpengantar, body: {
                                'barcode': _barcodeString,
                              });
                              var datains = jsonDecode(res.body);
                              // String mes = datains['pes'];
                              String nim = datains['nim'];
                              String nama = datains['nama'];
                              String foto = datains['foto'];

                              print(nim);
                              print(nama);
                              print(foto);
                              showDialog(
                                context: context,
                                builder: (BuildContext context) {
                                  return AlertDialog(
                                    content: new Container(
                                      child: Column(
                                        children: <Widget>[
                                          Flexible(
                                            flex: 2,
                                            child: Image.network(Baseurl.ip +
                                                "/muaz_ta/assets/images/mahasiswa/" +
                                                foto),
                                          ),
                                          Flexible(
                                            flex: 1,
                                            child: Text(nim),
                                          ),
                                          Flexible(
                                            flex: 1,
                                            child: Text(nama),
                                          ),
                                          new Container(
                                            child: Column(
                                              children: <Widget>[
                                                Row(
                                                  children: <Widget>[
                                                    Padding(
                                                      padding:
                                                          const EdgeInsets.all(
                                                              8.0),
                                                      child: new RaisedButton(
                                                        color: Colors.blue,
                                                        child: new Text("Hadir",
                                                            style: TextStyle(
                                                                color: Colors
                                                                    .white)),
                                                        onPressed: () {
                                                          setState(() {
                                                            Util.nim = nim;
                                                            Util.ab = 'h';
                                                            Util.pert =
                                                                temu['per'];
                                                          });
                                                          absendata();
                                                          Navigator.of(context)
                                                              .pop();
                                                        },
                                                      ),
                                                    ),
                                                    Padding(
                                                      padding:
                                                          const EdgeInsets.all(
                                                              8.0),
                                                      child: new RaisedButton(
                                                        color: Colors.blue,
                                                        child: new Text("Alpa",
                                                            style: TextStyle(
                                                                color: Colors
                                                                    .white)),
                                                        onPressed: () {
                                                          setState(() {
                                                            Util.nim = nim;
                                                            Util.ab = 'a';
                                                            Util.pert =
                                                                temu['per'];
                                                          });
                                                          absendata();
                                                          Navigator.of(context)
                                                              .pop();
                                                        },
                                                      ),
                                                    ),
                                                  ],
                                                ),
                                                Row(
                                                  children: <Widget>[
                                                    Padding(
                                                      padding:
                                                          const EdgeInsets.all(
                                                              8.0),
                                                      child: new RaisedButton(
                                                        color: Colors.blue,
                                                        child: new Text(
                                                          "Izin",
                                                          style: TextStyle(
                                                              color:
                                                                  Colors.white),
                                                        ),
                                                        onPressed: () {
                                                          setState(() {
                                                            Util.nim = nim;
                                                            Util.ab = 'i';
                                                            Util.pert =
                                                                temu['per'];
                                                          });
                                                          absendata();
                                                          Navigator.of(context)
                                                              .pop();
                                                        },
                                                      ),
                                                    ),
                                                    Padding(
                                                      padding:
                                                          const EdgeInsets.all(
                                                              8.0),
                                                      child: new RaisedButton(
                                                        color: Colors.blue,
                                                        child: new Text("Sakit",
                                                            style: TextStyle(
                                                                color: Colors
                                                                    .white)),
                                                        onPressed: () {
                                                          setState(() {
                                                            Util.nim = nim;
                                                            Util.ab = 's';
                                                            Util.pert =
                                                                temu['per'];
                                                          });
                                                          absendata();
                                                          Navigator.of(context)
                                                              .pop();
                                                        },
                                                      ),
                                                    ),
                                                  ],
                                                ),
                                              ],
                                            ),
                                          ),
                                        ],
                                      ),
                                    ),
                                    actions: <Widget>[
                                      RaisedButton(
                                        child: new Text(
                                          "Close",
                                          style: TextStyle(color: Colors.white),
                                        ),
                                        onPressed: () {
                                          Navigator.of(context).pop();
                                        },
                                      )
                                    ],
                                  );
                                },
                              );
                            }

                            scanup() async {
                              try {
                                String reader = await BarcodeScanner.scan();
                                if (!mounted) {
                                  return;
                                }
                                setState(() {
                                  _barcodeString = reader;
                                });
                                print("String = " + _barcodeString);
                                update(_barcodeString);
                              } on PlatformException catch (e) {
                                if (e.code ==
                                    BarcodeScanner.CameraAccessDenied) {
                                  requestPermission();
                                } else {
                                  setState(() =>
                                      _barcodeString = "unknown error : $e");
                                }
                              } on FormatException {
                                setState(() => _barcodeString =
                                    "user return without scanning");
                              } catch (e) {
                                setState(() =>
                                    _barcodeString = "unknown error : $e");
                              }
                            }

                            var st = new List(17);
                            st[1] = Util.cek1;
                            st[2] = Util.cek2;
                            st[3] = Util.cek3;
                            st[4] = Util.cek4;
                            st[5] = Util.cek5;
                            st[6] = Util.cek6;
                            st[7] = Util.cek7;
                            st[8] = Util.cek8;
                            st[9] = Util.cek9;
                            st[10] = Util.cek10;
                            st[11] = Util.cek11;
                            st[12] = Util.cek12;
                            st[13] = Util.cek13;
                            st[14] = Util.cek14;
                            st[15] = Util.cek15;
                            st[16] = Util.cek16;
                            int j = int.parse(temu['pertemuan']);
                            print(j);
                            print(st[j]);
                            print(Util.cek1);
                            // print(temu['pertemuan']);
                            // int c = int.parse(st[j]);
                            return Center(
                              child: Padding(
                                  padding: const EdgeInsets.all(10.0),
                                  child: Card(
                                    color: Colors.white,
                                    child: Center(
                                      child: InkWell(
                                        onTap: scanup,
                                        child: Padding(
                                          padding: const EdgeInsets.all(10.0),
                                          child: Center(
                                            child: Column(
                                              children: <Widget>[
                                                Center(
                                                    child: Text(
                                                  temu['pertemuan'],
                                                  style: TextStyle(
                                                      fontSize: 36.0,
                                                      color: st[j] == 0
                                                          ? Colors.black
                                                          : Colors.green),
                                                )),
                                              ],
                                            ),
                                          ),
                                        ),
                                      ),
                                    ),
                                  )),
                            );
                          },
                          childCount: pertemuan.length,
                        ),
                      )
                    ],
                  ),
                ),
                actions: <Widget>[
                  new FlatButton(
                    child: new Text("Close"),
                    onPressed: () {
                      Navigator.of(context).pop();
                    },
                  ),
                ],
              );
            },
          );
        },
        tooltip: 'Scan',
        child: Icon(Icons.camera_alt),
      ),
    );
  }

  Widget profile() {
    return Container(
      child: FloatingActionButton(
        heroTag: "btnProfile",
        onPressed: scan,
        tooltip: 'Profile',
        child: Icon(Icons.person_add),
      ),
    );
  }

  Widget toggle() {
    return Container(
      child: FloatingActionButton(
        backgroundColor: _buttonColor.value,
        onPressed: animate,
        tooltip: 'Toggle',
        child: AnimatedIcon(
          icon: AnimatedIcons.menu_close,
          progress: _animateIcon,
        ),
      ),
    );
  }

  String _barcodeString = '';
  Permission permission = Permission.Camera;

  requestPermission() async {
    bool result =
        (await SimplePermissions.requestPermission(permission)) as bool;
    return result;
  }

  void insert(String _barcodeString) async {
    final res = await http.post(Baseurl.insertabsenpengantar, body: {
      'barcode': _barcodeString,
      'mk': Util.mk,
      'kelas': Util.kelasantar
    });
    var datains = jsonDecode(res.body);
    String mes = datains['pes'];
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: new Text("Message"),
          content: new Text(mes),
          actions: <Widget>[
            new FlatButton(
              child: new Text("Close"),
              onPressed: () {
                _tampilmhs();
                Navigator.of(context).pop();
              },
            ),
          ],
        );
      },
    );
  }

  scan() async {
    try {
      String reader = await BarcodeScanner.scan();
      if (!mounted) {
        return;
      }
      setState(() {
        _barcodeString = reader;
      });
      insert(_barcodeString);
      print("String = " + _barcodeString);
    } on PlatformException catch (e) {
      if (e.code == BarcodeScanner.CameraAccessDenied) {
        requestPermission();
      } else {
        setState(() => _barcodeString = "unknown error : $e");
      }
    } on FormatException {
      setState(() => _barcodeString = "user return without scanning");
    } catch (e) {
      setState(() => _barcodeString = "unknown error : $e");
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text(Util.mk), backgroundColor: Colors.amber),
      body: RefreshIndicator(
        onRefresh: _tampilmhs,
        key: _refresh,
        child: SafeArea(
          child: Container(
            child: loading
                ? Center(child: CircularProgressIndicator())
                : notfound
                    ? Center(child: Text("No Data Found!"))
                    : ListView.separated(
                        separatorBuilder: (context, index) => Divider(
                              color: Colors.black12,
                            ),
                        itemCount: listmhs.length,
                        itemBuilder: (context, i) {
                          final res = listmhs[i];
                          double p = double.parse(res.persentase);
                          double sen = (p / 16) * 100;

                          return Container(
                            child: Padding(
                              padding:
                                  const EdgeInsets.symmetric(vertical: 5.0),
                              child: Column(
                                children: <Widget>[
                                  Row(
                                    children: <Widget>[
                                      Padding(
                                        padding: const EdgeInsets.all(8.0),
                                        child: Container(
                                          width: 50,
                                          height: 50,
                                          decoration: BoxDecoration(
                                              shape: BoxShape.circle,
                                              image: new DecorationImage(
                                                  fit: BoxFit.contain,
                                                  image: new NetworkImage(Baseurl
                                                          .ip +
                                                      '/muaz_ta/assets/images/mahasiswa/' +
                                                      res.foto))),
                                        ),
                                      ),
                                      Expanded(
                                        child: Column(
                                          crossAxisAlignment:
                                              CrossAxisAlignment.start,
                                          children: <Widget>[
                                            Text(res.nama,
                                                style: TextStyle(
                                                    fontWeight: FontWeight.bold,
                                                    fontSize: 18.0)),
                                            Text(res.nim),
                                          ],
                                        ),
                                      ),
                                      IconButton(
                                        onPressed: () {
                                          showDialog(
                                              context: context,
                                              builder: (BuildContext context) {
                                                return AlertDialog(
                                                  title: new Text("Info"),
                                                  content: Row(
                                                    children: <Widget>[
                                                      Text("Kehadiran = " +
                                                          sen.toString() +
                                                          ' %')
                                                    ],
                                                  ),
                                                  actions: <Widget>[
                                                    new FlatButton(
                                                      child: new Text("Close"),
                                                      onPressed: () {
                                                        Navigator.of(context)
                                                            .pop();
                                                      },
                                                    ),
                                                  ],
                                                );
                                              });
                                        },
                                        icon: p < 13
                                            ? Icon(
                                                Icons.info_outline,
                                                color: Colors.red,
                                              )
                                            : Icon(Icons.info_outline,
                                                color: Colors.green),
                                      )
                                    ],
                                  )
                                ],
                              ),
                            ),
                          );
                        },
                      ),
          ),
        ),
      ),
      floatingActionButton: Padding(
        padding: const EdgeInsets.only(bottom: 30.0, right: 10.0),
        child: Column(
          // crossAxisAlignment: CrossAxisAlignment.end,
          mainAxisAlignment: MainAxisAlignment.end,
          children: <Widget>[
            Transform(
              transform: Matrix4.translationValues(
                0.0,
                _translateButton.value * 2.0,
                0.0,
              ),
              child: profile(),
            ),
            Transform(
              transform: Matrix4.translationValues(
                0.0,
                _translateButton.value,
                0.0,
              ),
              child: camera(),
            ),
            toggle(),
          ],
        ),
      ),
    );
  }
}
