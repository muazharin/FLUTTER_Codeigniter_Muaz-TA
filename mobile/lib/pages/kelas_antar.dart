import 'package:flutter/material.dart';
import 'package:mobile/model/util.dart';
import 'package:mobile/model/siderbar.dart';

class KelasAntar extends StatefulWidget {
  @override
  _KelasAntarState createState() => _KelasAntarState();
}

class _KelasAntarState extends State<KelasAntar> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Semester " +
            Util.semester_antar.toString() +
            "(" +
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
        ),
      ),
    );
  }
}
