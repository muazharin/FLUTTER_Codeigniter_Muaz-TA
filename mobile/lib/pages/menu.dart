import 'package:flutter/material.dart';
import 'package:mobile/model/constant.dart';
import 'dart:convert';

String peminatanJson =
    '{"menuPeminatan":[{"item":"RPL","foto":"rpl.png"},{"item":"KCV","foto":"kcv.png"},{"item":"KBJ","foto":"kbj.png"}]}';
String pengantarJson =
    '{"menuPengantar":[{"semester":"1","foto":"sms1.png"},{"semester":"2","foto":"sms2.png"},{"semester":"3","foto":"sms3.png"},{"semester":"4","foto":"sms4.png"}]}';

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
    // TODO: implement initState
    super.initState();

    Map<String, dynamic> decodedPeminatan = json.decode(peminatanJson);
    peminatan = decodedPeminatan['menuPeminatan'];

    Map<String, dynamic> decodedPengantar = json.decode(pengantarJson);
    pengantar = decodedPengantar['menuPengantar'];
  }

  void pilihAksi(String pilih) {
    switch (pilih) {
      case Constant.signOut:
        setState(() {
          widget.signOut();
        });
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
          leading: Icon(Icons.home),
          title: Center(child: Text('Home')),
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
        body: Container(
          decoration: BoxDecoration(
              image: DecorationImage(
                  image: AssetImage('img/we.png'), fit: BoxFit.cover)),
          child: CustomScrollView(
            controller: _scrollController,
            slivers: <Widget>[
              SliverToBoxAdapter(
                child: Padding(
                  padding: EdgeInsets.only(top: 10.0, left: 5.0, right: 5.0),
                  child: SizedBox(
                    height: 120.0,
                    width: double.infinity,
                    child: ListView.builder(
                      scrollDirection: Axis.horizontal,
                      itemCount: peminatan.length,
                      itemBuilder: (context, index) {
                        Map<String, String> minat =
                            peminatan[index].cast<String, String>();
                        return Padding(
                          padding: const EdgeInsets.all(2.0),
                          child: Card(
                            color: Colors.blue[300],
                            child: InkWell(
                              onTap: () {
                                print(minat['item']);
                              },
                              child: Padding(
                                padding: const EdgeInsets.all(8.0),
                                child: Container(
                                    height: double.infinity,
                                    color: Colors.amber,
                                    child: Column(
                                      children: <Widget>[
                                        Image.asset(
                                          "img/logo.png",
                                          width: 50.0,
                                        ),
                                        Center(
                                          child: Padding(
                                            padding: EdgeInsets.fromLTRB(
                                                40.0, 10.0, 40.0, 0.0),
                                            child: Text(minat['item'],
                                                style: TextStyle(
                                                    color: Colors.black54,
                                                    fontWeight:
                                                        FontWeight.bold)),
                                          ),
                                        ),
                                      ],
                                    )),
                              ),
                            ),
                          ),
                        );
                      },
                    ),
                  ),
                ),
              ),
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
                        color: Colors.amber,
                        child: InkWell(
                          onTap: () {
                            print(antar['semester']);
                          },
                          child: Padding(
                            padding: const EdgeInsets.all(8.0),
                            child: Column(children: <Widget>[
                              Flexible(
                                flex: 3,
                                child: Container(
                                  child: Column(children: <Widget>[
                                    Image.asset(
                                      "img/logo.png",
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
        )
        // drawer: Drawer(),
        );
  }
}
