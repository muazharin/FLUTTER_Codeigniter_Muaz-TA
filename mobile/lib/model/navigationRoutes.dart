import 'package:flutter/material.dart';

class NavigationRoutes {
  static void switchToKelasMinat(BuildContext context) {
    Navigator.pushNamed(context, '/minat');
  }

  static void switchToKelasAntar(BuildContext context) {
    Navigator.pushNamed(context, '/antar');
  }

  static void switchToScanAntar(BuildContext context) {
    Navigator.pushNamed(context, '/scanantar');
  }

  static void switchToScanMinat(BuildContext context) {
    Navigator.pushNamed(context, '/scanminat');
  }

  static void switchToAbout(BuildContext context) {
    Navigator.pushNamed(context, '/about');
  }
}
