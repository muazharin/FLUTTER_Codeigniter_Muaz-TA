import 'package:flutter/material.dart';
import 'package:mobile/model/util.dart';
import 'package:mobile/model/navigationRoutes.dart';
import 'package:mobile/model/baseurl.dart';
import 'package:shared_preferences/shared_preferences.dart';

class Sidebar extends StatefulWidget {
  @override
  _SidebarState createState() => _SidebarState();
}

class _SidebarState extends State<Sidebar> {
  getPref() async {
    SharedPreferences sharedPreferences = await SharedPreferences.getInstance();
    setState(() {
      Util.username = sharedPreferences.getString("username");
      Util.foto = sharedPreferences.getString("foto");
    });
  }

  @override
  void initState() {
    super.initState();
    getPref();
  }

  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: new Container(
        child: ListView(
          children: <Widget>[
            new UserAccountsDrawerHeader(
              accountName: Text(Util.username),
              accountEmail: Text('alfanmuazharin@gmail.com'),
              currentAccountPicture: Image.network(
                  Baseurl.ip + '/muaz_ta/assets/images/' + Util.foto),
              decoration: BoxDecoration(
                  image: new DecorationImage(
                      image: NetworkImage(Baseurl.ip +
                          '/muaz_ta/assets/images/user-img-background.jpg'),
                      fit: BoxFit.cover)),
            ),
            new SingleChildScrollView(
              child: Column(
                children: <Widget>[
                  ListTile(
                    title: Text("Ganjil"),
                    leading: Icon(Icons.blur_circular),
                    trailing: Icon(Icons.arrow_right),
                    onTap: () {
                      setState(() {
                        Util.kelasantar = "ganjil";
                      });
                      Navigator.pop(context);
                      Navigator.pop(context);
                      NavigationRoutes.switchToKelasAntar(context);
                    },
                  ),
                  ListTile(
                    title: Text("Genap"),
                    leading: Icon(Icons.blur_circular),
                    trailing: Icon(Icons.arrow_right),
                    onTap: () {
                      setState(() {
                        Util.kelasantar = "genap";
                      });
                      Navigator.pop(context);
                      Navigator.pop(context);
                      NavigationRoutes.switchToKelasAntar(context);
                    },
                  ),
                  ListTile(
                    title: Text("Ganjil/Genap"),
                    leading: Icon(Icons.blur_circular),
                    trailing: Icon(Icons.arrow_right),
                    onTap: () {
                      setState(() {
                        Util.kelasantar = "ganjil/genap";
                      });
                      Navigator.pop(context);
                      Navigator.pop(context);
                      NavigationRoutes.switchToKelasAntar(context);
                    },
                  ),
                ],
              ),
            )
          ],
        ),
      ),
    );
  }
}
