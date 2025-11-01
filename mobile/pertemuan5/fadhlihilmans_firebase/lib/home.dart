import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:flutter/material.dart';
import 'tambah_data.dart';
import 'edit_data.dart';

class Home extends StatefulWidget {
  @override
  HomeState createState() => HomeState();
}

class HomeState extends State<Home> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Database Firebase'),
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => TambahData(),
            ),
          );
        },
        child: Icon(Icons.add),
      ),
      body: StreamBuilder(
        stream: FirebaseFirestore.instance.collection('mahasiswa').snapshots(),
        builder: (context, snapshot) {
          if (snapshot.hasData) {
            return Container(
              padding: EdgeInsets.fromLTRB(5, 10, 5, 5),
              child: Card(
                child: ListView.builder(
                  shrinkWrap: true,
                  itemCount: snapshot.data!.docs.length,
                  itemBuilder: (context, index) {
                    DocumentSnapshot documentSnapshot =
                        snapshot.data!.docs[index];
                    return Column(
                      children: [
                        GestureDetector(
                          child: ListTile(
                            leading: Icon(Icons.person),
                            title: Text(documentSnapshot["nim"]),
                            // subtitle: Text(documentSnapshot["nama"]),
                            subtitle: Column(
                              crossAxisAlignment: CrossAxisAlignment
                                  .start, // Agar teks rata kiri
                              children: [
                                Text(documentSnapshot["nama"]),
                                Text(
                                  'Prodi: ${documentSnapshot["prodi"]}',
                                  style: TextStyle(fontSize: 12),
                                ),
                                Text(
                                  'Kelas: ${documentSnapshot["kelas"]}',
                                  style: TextStyle(fontSize: 12),
                                ),
                              ],
                            ),
                            trailing: Icon(Icons.navigate_next_rounded),
                          ),
                          onTap: () => Navigator.push(
                            context,
                            MaterialPageRoute(
                              builder: (context) => EditData(
                                nim: documentSnapshot["nim"],
                                nama: documentSnapshot["nama"],
                                prodi: documentSnapshot["prodi"],
                                kelas: documentSnapshot["kelas"],
                              ),
                            ),
                          ),
                        ),
                        Divider(
                          color: Colors.black,
                          indent: 10,
                          endIndent: 10,
                        )
                      ],
                    );
                  },
                ),
              ),
            );
          } else {
            return Center(
              child: CircularProgressIndicator(
                backgroundColor: Colors.black,
              ),
            );
          }
        },
      ),
    );
  }
}
