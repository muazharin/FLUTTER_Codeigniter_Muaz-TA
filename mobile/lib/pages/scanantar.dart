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

  @override
  void initState() {
    _tampilmhs();
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
        // onPressed: scan,
        onPressed: null,
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
                              color: Colors.black,
                            ),
                        itemCount: listmhs.length,
                        itemBuilder: (context, i) {
                          final res = listmhs[i];
                          int p = int.parse(res.persentase);
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
                                        onPressed: null,
                                        icon: p <= 13
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
