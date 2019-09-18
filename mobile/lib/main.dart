import 'package:flutter/material.dart';
import 'package:splashscreen/splashscreen.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:mobile/form/formValidation.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:mobile/pages/menu.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:mobile/pages/kelas_minat.dart';
import 'package:mobile/pages/kelas_antar.dart';
import 'package:mobile/model/baseurl.dart';
import 'package:mobile/model/util.dart';
import 'package:mobile/pages/scanantar.dart';

void main() => runApp(MyApp1());

class MyApp1 extends StatefulWidget {
  @override
  _MyApp1State createState() => _MyApp1State();
}

class _MyApp1State extends State<MyApp1> {
  @override
  Widget build(BuildContext context) {
    return new MaterialApp(
        home: new MyApp(),
        debugShowCheckedModeBanner: false,
        routes: <String, WidgetBuilder>{
          '/minat': (BuildContext context) => new KelasMinat(),
          '/antar': (BuildContext context) => new KelasAntar(),
          '/scanantar': (BuildContext context) => new ScanAntar(),
        });
  }
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
        seconds: 3,
        navigateAfterSeconds: new AfterSplash(),
        loaderColor: Colors.red);
  }
}

class AfterSplash extends StatefulWidget {
  @override
  _AfterSplashState createState() => _AfterSplashState();
}

enum LoginStatus { notSignIn, signIn }

class _AfterSplashState extends State<AfterSplash> {
  LoginStatus _loginStatus = LoginStatus.notSignIn;
  String _username, _password;
  final _key = new GlobalKey<FormState>();
  bool _validate = false;
  bool _secureText = true;

  showHide() {
    setState(() {
      _secureText = !_secureText;
    });
  }

  login() async {
    if (_key.currentState.validate()) {
      _key.currentState.save();
      final response = await http.post(Baseurl.login,
          body: {'username': _username, 'password': _password});
      var datausr = jsonDecode(response.body);
      int value = datausr[0]['value'];
      String username = datausr[0]['username'];
      String foto = datausr[0]['foto'];
      // String status = datausr[0]['status'];
      if (value == 1) {
        print(value);
        setState(() {
          _loginStatus = LoginStatus.signIn;
          savePref(value, username, foto);
        });
      } else {
        print(value);
        showDialog(
          context: context,
          builder: (BuildContext context) {
            return AlertDialog(
              title: new Text("Login"),
              content: new Text("Username atau Password Anda Salah!"),
              actions: <Widget>[
                new FlatButton(
                  child: new Text("Close"),
                  onPressed: () {
                    Navigator.of(context).pop();
                  },
                ),
              ],
            );
          },
        );
      }
    }
  }

  savePref(int value, String username, String foto) async {
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    setState(() {
      sharedPreferences.setInt("value", value);
      sharedPreferences.setString("username", username);
      sharedPreferences.setString("foto", foto);
      sharedPreferences.commit();
    });
  }

  var value;
  getPref() async {
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    setState(() {
      value = sharedPreferences.getInt('value');

      _loginStatus = value == 1 ? LoginStatus.signIn : LoginStatus.notSignIn;
    });
  }

  signOut() async {
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    setState(() {
      sharedPreferences.setInt("value", null);
      sharedPreferences.setString("username", null);
      sharedPreferences.setString("foto", null);
      sharedPreferences.commit();
      Util.value = 0;
      Util.username = '';
      Util.foto = '';
      Util.status = '';
      Util.kelasminat = '';
      Util.kelasantar = 'ganjil';
      Util.semesterminat = 5;
      Util.semesterantar = 1;
      Util.sidebar = '';
      _loginStatus = LoginStatus.notSignIn;
    });
  }

  @override
  void initState() {
    super.initState();
    getPref();
  }

  @override
  Widget build(BuildContext context) {
    switch (_loginStatus) {
      case LoginStatus.notSignIn:
        ScreenUtil.instance = ScreenUtil.getInstance()..init(context);
        ScreenUtil.instance =
            ScreenUtil(width: 750, height: 1334, allowFontScaling: true);
        return SafeArea(
          child: new Scaffold(
            backgroundColor: Colors.amber,
            resizeToAvoidBottomPadding: false,
            body: new Stack(
              fit: StackFit.expand,
              children: <Widget>[
                Column(
                  crossAxisAlignment: CrossAxisAlignment.end,
                  children: <Widget>[
                    Center(
                      child: Padding(
                          padding: EdgeInsets.only(top: 50.0),
                          child: Image.asset(
                            "img/logo.png",
                            height: 120.0,
                          )),
                    ),
                    Expanded(
                      child: Container(),
                    ),
                    Image.asset('img/image_02.png', color: Colors.white)
                  ],
                ),
                SingleChildScrollView(
                  child: Padding(
                      padding:
                          EdgeInsets.only(left: 28.0, right: 28.0, top: 60),
                      child: Column(
                        children: <Widget>[
                          SizedBox(
                              height: ScreenUtil.getInstance().setHeight(300)),
                          // FormCardLogin(),
                          Column(children: <Widget>[
                            Container(
                              width: double.infinity,
                              height: ScreenUtil.getInstance().setHeight(480),
                              decoration: BoxDecoration(
                                  color: Colors.white,
                                  borderRadius: BorderRadius.circular(8.0),
                                  boxShadow: [
                                    BoxShadow(
                                        color: Colors.black12,
                                        offset: Offset(0.0, 15.0),
                                        blurRadius: 15.0),
                                    BoxShadow(
                                        color: Colors.black12,
                                        offset: Offset(0.0, -10.0),
                                        blurRadius: 10.0)
                                  ]),
                              child: Padding(
                                padding:
                                    EdgeInsets.fromLTRB(24.0, 24.0, 24.0, 0),
                                child: SingleChildScrollView(
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: <Widget>[
                                      Center(
                                        child: Text(
                                          "LOGIN",
                                          style: TextStyle(
                                              fontSize: ScreenUtil.getInstance()
                                                  .setSp(45),
                                              fontWeight: FontWeight.bold,
                                              letterSpacing: .6),
                                        ),
                                      ),
                                      SizedBox(
                                        height: ScreenUtil.getInstance()
                                            .setHeight(20),
                                      ),
                                      Form(
                                        key: _key,
                                        autovalidate: _validate,
                                        child: Column(
                                          crossAxisAlignment:
                                              CrossAxisAlignment.start,
                                          children: <Widget>[
                                            Text("Username",
                                                style: TextStyle(
                                                    fontSize:
                                                        ScreenUtil.getInstance()
                                                            .setSp(24))),
                                            TextFormField(
                                              validator: validationUser,
                                              onSaved: (String val) {
                                                _username = val;
                                              },
                                              decoration: InputDecoration(
                                                hintText: "Enter username",
                                                hintStyle: TextStyle(
                                                    color: Colors.grey,
                                                    fontSize: 12.0),
                                              ),
                                            ),
                                            SizedBox(
                                              height: ScreenUtil.getInstance()
                                                  .setHeight(30),
                                            ),
                                            Text("Password",
                                                style: TextStyle(
                                                    fontSize:
                                                        ScreenUtil.getInstance()
                                                            .setSp(24))),
                                            TextFormField(
                                              validator: validationPass,
                                              onSaved: (String val) {
                                                _password = val;
                                              },
                                              obscureText: _secureText,
                                              decoration: InputDecoration(
                                                suffixIcon: IconButton(
                                                  onPressed: showHide,
                                                  icon: Icon(_secureText
                                                      ? Icons.visibility_off
                                                      : Icons.visibility),
                                                ),
                                                hintText: "Enter password",
                                                hintStyle: TextStyle(
                                                    color: Colors.grey,
                                                    fontSize: 12.0),
                                              ),
                                            )
                                          ],
                                        ),
                                      )
                                    ],
                                  ),
                                ),
                              ),
                            ),
                            SizedBox(
                                height: ScreenUtil.getInstance().setHeight(30)),
                            InkWell(
                              child: Container(
                                width: double.infinity,
                                height: ScreenUtil.getInstance().setHeight(100),
                                decoration: BoxDecoration(
                                    gradient: LinearGradient(colors: [
                                      Color.fromRGBO(0, 146, 63, 0.8),
                                      Color.fromRGBO(0, 147, 221, 0.8),
                                    ]),
                                    borderRadius: BorderRadius.circular(6.0),
                                    boxShadow: [
                                      BoxShadow(
                                          color:
                                              Color.fromRGBO(0, 147, 221, 0.8),
                                          offset: Offset(0.0, 8.0),
                                          blurRadius: 8.0)
                                    ]),
                                child: Material(
                                  color: Colors.transparent,
                                  child: InkWell(
                                    onTap: login,
                                    // onTap: () {},
                                    child: Center(
                                      child: Text("Sign In",
                                          style: TextStyle(
                                              color: Colors.white,
                                              fontSize: 15,
                                              letterSpacing: 1.0)),
                                    ),
                                  ),
                                ),
                              ),
                            ),
                          ]),
                        ],
                      )),
                )
              ],
            ),
          ),
        );
        break;
      case LoginStatus.signIn:
        return MainMenu(signOut);
        break;
      default:
        return Container();
    }
  }
}
