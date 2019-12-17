String ip = "";
String validationName(String value) {
  if (value.length == 0) {
    return "Name is Required";
  } else {
    return null;
  }
}

String validationUser(String value) {
  if (value.length == 0) {
    return "Username is Required";
  } else {
    return null;
  }
}

String validationVisi(String value) {
  if (value.length == 0) {
    return "Visi is Required";
  } else {
    return null;
  }
}

String validationPass(String value) {
  if (value.length == 0) {
    return "Password is Required";
  } else if (value.length < 6) {
    return "Password is at least 6 characters";
  }
  return null;
}

String validationEmail(String value) {
  String pattern =
      r'^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$';
  RegExp regExp = new RegExp(pattern);
  if (value.length == 0) {
    return "Email is Required";
  } else if (!regExp.hasMatch(value)) {
    return "Invalid Email";
  } else {
    return null;
  }
}

String validationPhone(String value) {
  String patttern = r'(^[0-9]*$)';
  RegExp regExp = new RegExp(patttern);
  if (value.length == 0) {
    return "Mobile is Required";
  } else if (value.length != 12) {
    return "Mobile number must 10 digits";
  } else if (!regExp.hasMatch(value)) {
    return "Mobile Number must be digits";
  }
  return null;
}
