import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:mobile/form/formValidation.dart';

class FormCardLogin extends StatefulWidget {
  @override
  _FormCardLoginState createState() => _FormCardLoginState();
}

class _FormCardLoginState extends State<FormCardLogin> {
  String _username, _password;
  @override
  Widget build(BuildContext context) {
    return Column(children: <Widget>[
      Container(
        width: double.infinity,
        height: ScreenUtil.getInstance().setHeight(450),
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
          padding: EdgeInsets.fromLTRB(16.0, 16.0, 16.0, 0),
          child: SingleChildScrollView(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: <Widget>[
                Center(
                  child: Text(
                    "LOGIN",
                    style: TextStyle(
                        fontSize: ScreenUtil.getInstance().setSp(45),
                        fontWeight: FontWeight.bold,
                        letterSpacing: .6),
                  ),
                ),
                SizedBox(
                  height: ScreenUtil.getInstance().setHeight(20),
                ),
                Form(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: <Widget>[
                      Text("Username",
                          style: TextStyle(
                              fontSize: ScreenUtil.getInstance().setSp(24))),
                      TextFormField(
                        validator: validationUser,
                        onSaved: (String val) {
                          _username = val;
                        },
                        decoration: InputDecoration(
                          hintText: "username",
                          hintStyle:
                              TextStyle(color: Colors.grey, fontSize: 12.0),
                        ),
                      ),
                      SizedBox(
                        height: ScreenUtil.getInstance().setHeight(30),
                      ),
                      Text("Password",
                          style: TextStyle(
                              fontSize: ScreenUtil.getInstance().setSp(24))),
                      TextFormField(
                        validator: validationPass,
                        onSaved: (String val) {
                          _password = val;
                        },
                        obscureText: true,
                        decoration: InputDecoration(
                          hintText: "password",
                          hintStyle:
                              TextStyle(color: Colors.grey, fontSize: 12.0),
                        ),
                      )
                    ],
                  ),
                )
              ],
            ),
          ),
        ),
      )
    ]);
  }
}
