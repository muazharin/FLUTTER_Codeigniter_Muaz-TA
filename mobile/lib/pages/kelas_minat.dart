import 'package:flutter/material.dart';
import 'package:mobile/model/util.dart';
import 'package:mobile/model/siderbar.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:mobile/model/baseurl.dart';
import 'package:mobile/model/navigationRoutes.dart';
import 'package:mobile/model/mkpeminatan.dart';

class KelasMinat extends StatefulWidget {
  @override
  _KelasMinatState createState() => _KelasMinatState();
}

class _KelasMinatState extends State<KelasMinat> {
  var loading = false;
  var notfound = false;
  final list = new List<MkPeminatan>();
  final GlobalKey<RefreshIndicatorState> _refresh =
      new GlobalKey<RefreshIndicatorState>();
  Future<void> _tampilmk() async {
    list.clear();
    setState(() {
      loading = true;
      notfound = false;
    });
    final response = await http.post(Baseurl.mkpeminatan, body: {
      "semester": Util.semesterminat.toString(),
      "kelas": Util.kelasminat
    });
    if (response.contentLength == 2) {
      setState(() {
        loading = false;
        notfound = true;
      });
    } else {
      final data = jsonDecode(response.body);
      data.forEach((api) {
        final ok = new MkPeminatan(
            api['kodematakuliah'],
            api['namamatakuliah'],
            api['dosensatu'],
            api['hari'],
            api['mulai'],
            api['selesai'],
            api['ruang']);
        list.add(ok);
      });
      setState(() {
        loading = false;
        notfound = false;
      });
    }
  }

  @override
  void initState() {
    _tampilmk();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
            Util.kelasminat + "_Semester " + Util.semesterminat.toString()),
        backgroundColor: Colors.amber,
      ),
      drawer: Sidebar(),
      body: RefreshIndicator(
        onRefresh: _tampilmk,
        key: _refresh,
        child: SafeArea(
          child: Container(
            decoration: BoxDecoration(
                image: DecorationImage(
                    image: AssetImage('img/we.png'), fit: BoxFit.cover)),
            child: loading
                ? Center(child: CircularProgressIndicator())
                : notfound
                    ? Center(child: Text("No Data Found!"))
                    : ListView.builder(
                        itemCount: list.length,
                        itemBuilder: (context, i) {
                          final res = list[i];

                          void detail() {
                            showDialog(
                              context: context,
                              builder: (BuildContext context) {
                                return SimpleDialog(
                                  title: Center(child: new Text("Detail")),
                                  children: <Widget>[
                                    Padding(
                                      padding: const EdgeInsets.fromLTRB(
                                          20.0, 0.0, 20.0, 0.0),
                                      child: Container(
                                        child: Column(
                                          crossAxisAlignment:
                                              CrossAxisAlignment.start,
                                          children: <Widget>[
                                            Text(res.kodematakuliah),
                                            Text(
                                              res.namamatakuliah,
                                              style: TextStyle(
                                                  fontWeight: FontWeight.bold),
                                            ),
                                            Text(res.dosensatu),
                                            Text(res.hari),
                                            Text(res.mulai +
                                                " - " +
                                                res.selesai),
                                            Text(res.ruang),
                                            ButtonBar(
                                              children: <Widget>[
                                                FlatButton(
                                                  child: Text('Close'),
                                                  onPressed: () {
                                                    Navigator.pop(context);
                                                  },
                                                )
                                              ],
                                            )
                                          ],
                                        ),
                                      ),
                                    )
                                  ],
                                );
                              },
                            );
                          }

                          return Container(
                              child: Padding(
                            padding: const EdgeInsets.symmetric(vertical: 0.0),
                            child: Column(children: <Widget>[
                              Card(
                                child: InkWell(
                                  onTap: () {
                                    setState(() {
                                      // _cekpertemuan();
                                      Util.mk = res.namamatakuliah;
                                    });
                                    NavigationRoutes.switchToScanMinat(context);
                                  },
                                  child: Container(
                                    child: Padding(
                                      padding: const EdgeInsets.all(10.0),
                                      child: Row(
                                        children: <Widget>[
                                          Expanded(
                                            child: Column(
                                              crossAxisAlignment:
                                                  CrossAxisAlignment.start,
                                              children: <Widget>[
                                                // Text(res.kodematakuliah),
                                                Text(res.namamatakuliah,
                                                    style: TextStyle(
                                                        fontSize: 16.0,
                                                        fontWeight:
                                                            FontWeight.bold)),
                                                // Text(res.dosensatu),
                                                Text(res.hari),
                                                Text(res.mulai +
                                                    "-" +
                                                    res.selesai),
                                                Text(res.ruang)
                                              ],
                                            ),
                                          ),
                                          IconButton(
                                            onPressed: detail,
                                            icon: Icon(
                                              Icons.assignment,
                                              size: 30.0,
                                            ),
                                          )
                                        ],
                                      ),
                                    ),
                                  ),
                                ),
                              )
                            ]),
                          ));
                        },
                      ),
          ),
        ),
      ),
    );
  }
}
