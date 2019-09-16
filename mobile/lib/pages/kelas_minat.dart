import 'package:flutter/material.dart';
import 'package:mobile/model/util.dart';

class KelasMinat extends StatefulWidget {
  @override
  _KelasMinatState createState() => _KelasMinatState();
}

class _KelasMinatState extends State<KelasMinat> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(Util.kelasminat),
        backgroundColor: Colors.amber,
      ),
      drawer: Drawer(),
    );
  }
}
