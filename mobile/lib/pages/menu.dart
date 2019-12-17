import 'package:flutter/material.dart';
import 'package:mobile/model/constant.dart';
import 'dart:convert';
import 'package:mobile/model/navigationRoutes.dart';
import 'package:mobile/model/util.dart';

String peminatanJson =
    '{"menuPeminatan":[{"item":"RPL","foto":"rpl.png"},{"item":"KCV","foto":"kcv.png"},{"item":"KBJ","foto":"kbj.png"},{"item":"UMUM","foto":"umum.png"}]}';
String pengantarJson =
    '{"menuPengantar": [{"semester": "1","foto": "sms1.png"}, {"semester": "2","foto": "sms2.png"}, {"semester": "3","foto": "sms3.png"}, {"semester": "4","foto": "sms4.png"}, {"semester": "5","foto": "sms5.png"}, {"semester": "6","foto": "sms6.png"}, {"semester": "7","foto": "sms7.png"}, {"semester": "8","foto": "sms8.png"}]}';

class MainMenu extends StatefulWidget {
  final VoidCallback signOut;
  MainMenu(this.signOut);
  @override
  _MainMenuState createState() => _MainMenuState();
}

class _MainMenuState extends State<MainMenu> {
  final ScrollController _scrollController = ScrollController();
  List<dynamic> peminatan;
  List<dynamic> pengantar;

  @override
  void initState() {
    super.initState();

    Map<String, dynamic> decodedPeminatan = json.decode(peminatanJson);
    peminatan = decodedPeminatan['menuPeminatan'];

    Map<String, dynamic> decodedPengantar = json.decode(pengantarJson);
    pengantar = decodedPengantar['menuPengantar'];
  }

  void pilihAksi(String pilih) {
    switch (pilih) {
      case Constant.signOut:
        showDialog(
            context: context,
            builder: (BuildContext context) {
              // return object of type Dialog
              return AlertDialog(
                title: new Text("Exit"),
                content: new Text("Do you really want to exit?"),
                actions: <Widget>[
                  // usually buttons at the bottom of the dialog
                  new FlatButton(
                    child: new Text("Cancel"),
                    onPressed: () {
                      Navigator.of(context).pop();
                    },
                  ),
                  new FlatButton(
                    child: new Text("Yes"),
                    onPressed: () {
                      Navigator.of(context).pop();
                      widget.signOut();
                    },
                  )
                ],
              );
            });
        // setState(() {
        //   widget.signOut();
        // });
        break;
      case Constant.tentang:
        NavigationRoutes.switchToAbout(context);
        break;
      default:
    }
  }

  @override
  Widget build(BuildContext context) {
    return new Scaffold(
        // drawer: Drawer(),
        appBar: AppBar(
          backgroundColor: Colors.amber,
          // leading: Icon(Icons.home),
          title: Text('Home'),
          actions: <Widget>[
            PopupMenuButton<String>(
              onSelected: pilihAksi,
              itemBuilder: (BuildContext context) {
                return Constant.pilih.map((String pilih) {
                  return PopupMenuItem<String>(
                    value: pilih,
                    child: Text(pilih),
                  );
                }).toList();
              },
            )
          ],
        ),
        body: SafeArea(
          child: Container(
            decoration: BoxDecoration(
                image: DecorationImage(
                    image: AssetImage('img/we.png'), fit: BoxFit.cover)),
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
                      Map<String, String> antar =
                          pengantar[index].cast<String, String>();
                      return Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Card(
                          color: Colors.white,
                          child: InkWell(
                            // onTap: kelasp,
                            onTap: () {
                              setState(() {
                                int _sm = int.parse(antar['semester']);
                                Util.semesterantar = _sm;
                                Util.sidebar = "antar";
                              });
                              NavigationRoutes.switchToKelasAntar(context);
                            },
                            child: Padding(
                              padding: const EdgeInsets.all(8.0),
                              child: Column(children: <Widget>[
                                Flexible(
                                  flex: 3,
                                  child: Container(
                                    child: Column(children: <Widget>[
                                      Image.asset(
                                        "img/" + antar['foto'],
                                        width: 80.0,
                                      ),
                                    ]),
                                  ),
                                ),
                                Flexible(
                                  flex: 1,
                                  child: Container(
                                    color: Colors.blue[300],
                                    child: Column(children: <Widget>[
                                      Padding(
                                        padding:
                                            EdgeInsets.symmetric(vertical: 8.0),
                                        child: Center(
                                            child: Text(
                                          "Semester " + antar['semester'],
                                          style: TextStyle(
                                              color: Colors.black54,
                                              fontWeight: FontWeight.bold),
                                        )),
                                      ),
                                    ]),
                                  ),
                                )
                              ]),
                            ),
                          ),
                        ),
                      );
                    },
                    childCount: pengantar.length,
                  ),
                )
              ],
            ),
          ),
        )
        // drawer: Drawer(),
        );
  }
}
