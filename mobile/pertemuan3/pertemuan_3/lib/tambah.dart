import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'home.dart';

class Tambah extends StatefulWidget {
  @override
  _TambahState createState() => _TambahState();
}

class _TambahState extends State<Tambah> {
  TextEditingController nimController = TextEditingController();
  TextEditingController namaController = TextEditingController();
  TextEditingController prodiController = TextEditingController();
  TextEditingController kelasController = TextEditingController();

  void tambahData() {
    var url = Uri.parse("http://localhost:8080/mahasiswa");

    http.post(url, body: {
      "nim": nimController.text,
      "nama": namaController.text,
      "prodi": prodiController.text,
      "kelas": kelasController.text,
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("ADD DATA"),
      ),
      body: Padding(
        padding: EdgeInsets.all(10.0),
        child: ListView(
          children: <Widget>[
            Text(
              "Input Data Mahasiswa",
              style: TextStyle(
                color: Colors.red,
                fontStyle: FontStyle.italic,
                fontWeight: FontWeight.bold,
                fontSize: 25,
              ),
            ),
            SizedBox(
              height: 40,
            ),
            TextField(
              controller: nimController,
              decoration: InputDecoration(
                labelText: "NIM",
              ),
            ),
            TextField(
              controller: namaController,
              decoration: InputDecoration(labelText: "Nama"),
            ),
            TextField(
              controller: prodiController,
              decoration: InputDecoration(labelText: "Prodi"),
            ),
            TextField(
              controller: kelasController,
              decoration: InputDecoration(labelText: "Kelas"),
            ),
            SizedBox(
              height: 50,
            ),
            MaterialButton(
              color: Colors.blue,
              onPressed: () {
                tambahData();
                Navigator.pushAndRemoveUntil(
                  context,
                  MaterialPageRoute(builder: (context) => Home()),
                  (Route<dynamic> route) => false,
                );
                ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                  content: Text('Data berhasil disimpan'),
                ));
              },
              child: Text("Simpan"),
            ),
          ],
        ),
      ),
    );
  }
}
