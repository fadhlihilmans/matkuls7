import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'home.dart';

class Ubah extends StatefulWidget {
  final String? nim;
  final String? nama;
  final String? prodi;
  final String? kelas;

  Ubah({this.nim, this.nama, this.prodi, this.kelas});

  @override
  _UbahState createState() => _UbahState();
}

class _UbahState extends State<Ubah> {
  TextEditingController nimController = TextEditingController();
  TextEditingController namaController = TextEditingController();
  TextEditingController prodiController = TextEditingController();
  TextEditingController kelasController = TextEditingController();

  void ubahData() {
    var url =
        Uri.parse("http://localhost:8080/mahasiswa/${nimController.text}");
    http.put(url, body: {
      "nama": namaController.text,
      "prodi": prodiController.text,
      "kelas": kelasController.text,
    });
  }

  void hapusData() {
    var url =
        Uri.parse("http://localhost:8080/mahasiswa/${nimController.text}");
    http.delete(url);
  }

  void konfirmasi() {
    AlertDialog alertDialog = AlertDialog(
      content: Text("Apakah anda yakin akan menghapus data ${widget.nama}"),
      actions: <Widget>[
        MaterialButton(
          color: Colors.red,
          child: Text(
            "OK DELETE!",
            style: TextStyle(color: Colors.black),
          ),
          onPressed: () {
            hapusData();
            Navigator.pushAndRemoveUntil(
              context,
              MaterialPageRoute(builder: (context) => Home()),
              (Route<dynamic> route) => false,
            );
            ScaffoldMessenger.of(context).showSnackBar(SnackBar(
              content: Text('Data berhasil dihapus'),
            ));
          },
        ),
        MaterialButton(
          color: Colors.green,
          child: Text("CANCEL", style: TextStyle(color: Colors.black)),
          onPressed: () => Navigator.pop(context),
        ),
      ],
    );
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return alertDialog;
      },
    );
  }

  @override
  void initState() {
    nimController = TextEditingController(text: widget.nim);
    namaController = TextEditingController(text: widget.nama);
    prodiController = TextEditingController(text: widget.prodi);
    kelasController = TextEditingController(text: widget.kelas);
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("EDIT DATA"),
      ),
      body: Padding(
        padding: EdgeInsets.all(10.0),
        child: ListView(
          children: [
            Text(
              "Ubah Data Mahasiswa",
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
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceAround,
              children: [
                MaterialButton(
                  color: Colors.orange,
                  onPressed: () {
                    ubahData();
                    Navigator.pushAndRemoveUntil(
                      context,
                      MaterialPageRoute(builder: (context) => Home()),
                      (Route<dynamic> route) => false,
                    );
                    ScaffoldMessenger.of(context).showSnackBar(SnackBar(
                      content: Text('Data berhasil diubah'),
                    ));
                  },
                  child: Text("Ubah"),
                ),
                MaterialButton(
                  color: Colors.red,
                  onPressed: () {
                    konfirmasi();
                  },
                  child: Text("Hapus"),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }
}
