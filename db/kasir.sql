/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     11/30/2021 11:45:18 PM                       */
/*==============================================================*/


alter table ABSENSI 
   drop foreign key FK_ABSENSI_RELATIONS_PEGAWAI;

alter table DETIL_NOTA 
   drop foreign key FK_DETIL_NO_RELATIONS_BARANG;

alter table DETIL_NOTA 
   drop foreign key FK_DETIL_NO_RELATIONS_NOTA;

alter table PEMBELIAN 
   drop foreign key FK_PEMBELIA_RELATIONS_BARANG;


alter table ABSENSI 
   drop foreign key FK_ABSENSI_RELATIONS_PEGAWAI;

drop table if exists ABSENSI;

drop table if exists BARANG;


alter table DETIL_NOTA 
   drop foreign key FK_DETIL_NO_RELATIONS_BARANG;

alter table DETIL_NOTA 
   drop foreign key FK_DETIL_NO_RELATIONS_NOTA;

drop table if exists DETIL_NOTA;

drop table if exists NOTA;

drop table if exists PEGAWAI;


alter table PEMBELIAN 
   drop foreign key FK_PEMBELIA_RELATIONS_BARANG;

drop table if exists PEMBELIAN;

drop table if exists USER;

/*==============================================================*/
/* Table: ABSENSI                                               */
/*==============================================================*/
create table ABSENSI
(
   ID_ABSENSI           int not null  comment '',
   ID_PEGAWAI           varchar(8)  comment '',
   TANGGAL_ABSENSI      date not null  comment '',
   JAM_ABSENSI          time not null  comment '',
   primary key (ID_ABSENSI)
);

/*==============================================================*/
/* Table: BARANG                                                */
/*==============================================================*/
create table BARANG
(
   ID_BARANG            varchar(16) not null  comment '',
   NAMA_BARANG          varchar(50) not null  comment '',
   HARGA_BELI           int not null  comment '',
   HARGA_JUAL           int not null  comment '',
   STOK_BARANG          int not null  comment '',
   primary key (ID_BARANG)
);

/*==============================================================*/
/* Table: DETIL_NOTA                                            */
/*==============================================================*/
create table DETIL_NOTA
(
   ID_BARANG            varchar(16) not null  comment '',
   ID_NOTA              varchar(50) not null  comment '',
   NO                   int not null  comment '',
   JUMLAH_BARANG        int not null  comment '',
   TOTAL_HARGA          int not null  comment '',
   primary key (ID_BARANG, ID_NOTA, NO)
);

/*==============================================================*/
/* Table: NOTA                                                  */
/*==============================================================*/
create table NOTA
(
   ID_NOTA              varchar(50) not null  comment '',
   TOTAL_PENJUALAN      int not null  comment '',
   JAM_PENJUALAN        time not null  comment '',
   TANGGAL_PENJUALAN    date not null  comment '',
   primary key (ID_NOTA)
);

/*==============================================================*/
/* Table: PEGAWAI                                               */
/*==============================================================*/
create table PEGAWAI
(
   ID_PEGAWAI           varchar(8) not null  comment '',
   NAMA_PEGAWAI         varchar(50) not null  comment '',
   NO__TELP             varchar(14)  comment '',
   ALAMAT               text  comment '',
   primary key (ID_PEGAWAI)
);

/*==============================================================*/
/* Table: PEMBELIAN                                             */
/*==============================================================*/
create table PEMBELIAN
(
   ID_PEMBELIAN         int not null  comment '',
   ID_BARANG            varchar(16) not null  comment '',
   JUMLAH_PEMBELIAN     int not null  comment '',
   TOTAL_BAYAR          int not null  comment '',
   primary key (ID_PEMBELIAN)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   ID_USER              int not null  comment '',
   USERNAME             varchar(16) not null  comment '',
   PASSWORD             varchar(16) not null  comment '',
   NAMA                 varchar(50) not null  comment '',
   primary key (ID_USER)
);

alter table ABSENSI add constraint FK_ABSENSI_RELATIONS_PEGAWAI foreign key (ID_PEGAWAI)
      references PEGAWAI (ID_PEGAWAI) on delete restrict on update restrict;

alter table DETIL_NOTA add constraint FK_DETIL_NO_RELATIONS_BARANG foreign key (ID_BARANG)
      references BARANG (ID_BARANG) on delete restrict on update restrict;

alter table DETIL_NOTA add constraint FK_DETIL_NO_RELATIONS_NOTA foreign key (ID_NOTA)
      references NOTA (ID_NOTA) on delete restrict on update restrict;

alter table PEMBELIAN add constraint FK_PEMBELIA_RELATIONS_BARANG foreign key (ID_BARANG)
      references BARANG (ID_BARANG) on delete restrict on update restrict;

