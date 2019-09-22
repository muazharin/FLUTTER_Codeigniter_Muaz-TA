import 'package:flutter/material.dart';

class About extends StatefulWidget {
  @override
  _AboutState createState() => _AboutState();
}

class _AboutState extends State<About> {
  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Scaffold(
        appBar: AppBar(
          title: Text("About"),
          backgroundColor: Colors.amber,
        ),
        body: Center(
          child: Column(
            children: <Widget>[
              SizedBox(height: 200.0),
              Image.asset(
                'img/cxv.png',
                width: 100.0,
              ),
              SizedBox(height: 10.0),
              Text("TI App Scanner"),
              SizedBox(height: 20.0),
              Row(
                // crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisAlignment: MainAxisAlignment.center,
                children: <Widget>[
                  Text("2019 "),
                  Icon(Icons.copyright),
                  Text(" Code XV"),
                ],
              ),
              Center(
                child: Column(
                  children: <Widget>[
                    Text("Muaz - Code XV Developer"),
                    Text("Version 1.0.0")
                  ],
                ),
              ),
            ],
          ),
        ),
        // body: Center(
        //   child: Text("Muaz - Code XV Developer\nVersion 1.0.0"),
        // ),
      ),
    );
  }
}
