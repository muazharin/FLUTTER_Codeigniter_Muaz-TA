import 'package:flutter/material.dart';
import 'package:mobile/model/util.dart';
import 'package:mobile/model/siderbar.dart';

class KelasMinat extends StatefulWidget {
  @override
  _KelasMinatState createState() => _KelasMinatState();
}

class _KelasMinatState extends State<KelasMinat> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
            Util.kelasminat + "_Semester " + Util.semesterminat.toString()),
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
