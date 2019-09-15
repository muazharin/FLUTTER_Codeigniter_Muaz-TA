import 'package:flutter/material.dart';

class NavigationRoutes {
  static void switchToMenu(BuildContext context) {
    Navigator.pop(context);
    Navigator.pushReplacementNamed(context, '/menu');
  }
}
