import 'package:flutter/material.dart';
import 'package:mobile/model/util.dart';
import 'package:mobile/model/siderbar.dart';
import 'package:mobile/model/mk_pengantar.dart';
import 'package:http/http.dart' as http;
import 'package:mobile/model/baseurl.dart';
import 'dart:convert';

class KelasAntar extends StatefulWidget {
  @override
  _KelasAntarState createState() => _KelasAntarState();
}

class _KelasAntarState extends State<KelasAntar> {
  var loading = false;
  var notfound = false;
  final list = new List<MkPengantar>();
  _tampilmk() async {
    list.clear();
    setState(() {
      loading = true;
      notfound = false;
    });
    // final response = await http.get(Baseurl.mkpengantar +
    //     "/" +
    //     Util.semester_antar.toString() +
    //     "/" +
    //     Util.kelasantar);
    final response = await http.post(Baseurl.mkpengantar, body: {
      "semester": Util.semester_antar.toString(),
      "kelas": Util.kelasantar
    });
    if (response.contentLength == 2) {
      // showDialog(
      //     context: context,
      //     builder: (BuildContext context) {
      //       // return object of type Dialog
      //       return AlertDialog(
      //         title: new Text("Info!"),
      //         content: new Text("No data found!"),
      //         actions: <Widget>[
      //           // usually buttons at the bottom of the dialog
      //           new FlatButton(
      //             child: new Text("Ok"),
      //             onPressed: () {
      //               Navigator.of(context).pop();
      //             },
      //           ),
      //         ],
      //       );
      //     });
      setState(() {
        loading = false;
        notfound = true;
      });
    } else {
      final data = jsonDecode(response.body);
      data.forEach((api) {
        final ok = new MkPengantar(
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
    // TODO: implement initState
    super.initState();
    _tampilmk();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Semester " +
            Util.semester_antar.toString() +
            " (" +
            Util.kelasantar +
            ")"),
        backgroundColor: Colors.amber,
      ),
      drawer: Sidebar(),
      body: SafeArea(
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
                        return Container(
                            child: Padding(
                          padding:
                              const EdgeInsets.fromLTRB(8.0, 2.0, 8.0, 2.0),
                          child: Column(children: <Widget>[
                            Card(
                              child: InkWell(
                                onTap: () {},
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
                                          onPressed: () {},
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
    );
  }
}
