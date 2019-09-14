import 'package:flutter/material.dart';
import 'package:splashscreen/splashscreen.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:mobile/form/formCardLogin.dart';

void main() {
  runApp(new MaterialApp(
    home: new MyApp(),
    debugShowCheckedModeBanner: false,
  ));
}

class MyApp extends StatefulWidget {
  @override
  _MyAppState createState() => new _MyAppState();
}

class _MyAppState extends State<MyApp> {
  @override
  Widget build(BuildContext context) {
    return new SplashScreen(
        imageBackground: new AssetImage('img/teknik.png'),
        seconds: 5,
        navigateAfterSeconds: new AfterSplash(),
        loaderColor: Colors.red);
  }
}

class AfterSplash extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    ScreenUtil.instance = ScreenUtil.getInstance()..init(context);
    ScreenUtil.instance =
        ScreenUtil(width: 750, height: 1334, allowFontScaling: true);
    return new Scaffold(
      backgroundColor: Colors.amber,
      resizeToAvoidBottomPadding: false,
      body: new Stack(
        fit: StackFit.expand,
        children: <Widget>[
          Column(
            crossAxisAlignment: CrossAxisAlignment.end,
            children: <Widget>[
              Expanded(
                child: Container(),
              ),
              Image.asset('img/image_02.png', color: Colors.white)
            ],
          ),
          SingleChildScrollView(
            child: Padding(
                padding: EdgeInsets.only(left: 28.0, right: 28.0, top: 60),
                child: Column(
                  children: <Widget>[
                    SizedBox(height: ScreenUtil.getInstance().setHeight(200)),
                    FormCardLogin(),
                  ],
                )),
          )
        ],
      ),
    );
  }
}
