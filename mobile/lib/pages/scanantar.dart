import 'package:flutter/material.dart';
import 'package:barcode_scan/barcode_scan.dart';
import 'package:mobile/model/util.dart';
import 'package:mobile/model/mhspengantar.dart';
import 'package:mobile/model/baseurl.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

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

  _tampilmhs() async {
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
        onPressed: null,
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

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text(Util.mk), backgroundColor: Colors.amber),
      body: SafeArea(
        child: Container(
          decoration: BoxDecoration(
              image: DecorationImage(
                  image: AssetImage('img/we.png'), fit: BoxFit.cover)),
          child: loading
              ? Center(child: CircularProgressIndicator())
              : notfound
                  ? Center(child: Text("No Data Found"))
                  : ListView.separated(
                      separatorBuilder: (context, index) => Divider(
                            color: Colors.black,
                          ),
                      itemCount: listmhs.length,
                      itemBuilder: (context, i) {
                        final res = listmhs[i];
                        int p = int.parse(res.persentase);
                        return Container(
                          color: Colors.white,
                          child: Padding(
                            padding: const EdgeInsets.symmetric(vertical: 0.0),
                            child: Column(
                              children: <Widget>[
                                Row(
                                  children: <Widget>[
                                    Container(
                                      // width: 20,
                                      height: 20,

                                      decoration: BoxDecoration(
                                          image: new DecorationImage(
                                              image: new NetworkImage(Baseurl
                                                      .ip +
                                                  'assets/images/mahasiswa' +
                                                  res.foto))),
                                    ),
                                    Expanded(
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: <Widget>[
                                          Text(res.nama,
                                              style: TextStyle(
                                                  fontWeight: FontWeight.bold)),
                                          Text(res.nim),
                                        ],
                                      ),
                                    ),
                                    IconButton(
                                          onPressed: null,
                                      icon: p <= 13
                                          ? Icon(Icons.arrow_right)
                                          : Icon(Icons.arrow_left),
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
