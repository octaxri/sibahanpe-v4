-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2019 at 01:42 PM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sibahanpe`
--

-- --------------------------------------------------------

--
-- Table structure for table `hr_costum_info`
--

CREATE TABLE IF NOT EXISTS `hr_costum_info` (
  `Custom_No` int(11) DEFAULT '0',
  `Custom_Name` varchar(50) DEFAULT NULL,
  `Sort_HR` int(11) DEFAULT '0',
  `Sort_TA` int(11) DEFAULT '0',
  `Sort_AC` int(11) DEFAULT '0',
  `Sort_Pay` int(11) DEFAULT '0',
  `Be_Open` int(11) DEFAULT '0',
  `Be_Check` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_sidikjari`
--

CREATE TABLE IF NOT EXISTS `hr_sidikjari` (
  `FID` int(11) DEFAULT NULL,
  `SidikJari0_9000` longtext,
  `SidikJari1_9000` longtext,
  `SidikJari2_9000` longtext,
  `SidikJari3_9000` longtext,
  `SidikJari4_9000` longtext,
  `SidikJari5_9000` longtext,
  `SidikJari6_9000` longtext,
  `SidikJari7_9000` longtext,
  `SidikJari8_9000` longtext,
  `SidikJari9_9000` longtext,
  `Kartu_9000` longtext,
  `Password_9000` longtext,
  `Wajah_9000` longtext,
  `Privilage_9000` int(11) DEFAULT '0',
  `SidikJari0_8000` longblob,
  `SidikJari1_8000` longblob,
  `SidikJari2_8000` longblob,
  `Kartu_8000` longblob,
  `Password_8000` int(11) DEFAULT '0',
  `Wajah_8000` longblob,
  `Privilege_8000` int(11) DEFAULT NULL,
  KEY `FID` (`FID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_staff_info`
--

CREATE TABLE IF NOT EXISTS `hr_staff_info` (
  `FID` varchar(11) DEFAULT NULL COMMENT '4 digit',
  `Nama` varchar(50) DEFAULT NULL,
  `NIK` varchar(50) DEFAULT NULL,
  `DEPT_NAME` varchar(50) DEFAULT NULL,
  `JABATAN` varchar(50) DEFAULT NULL,
  `TGL_MASUK` varchar(50) DEFAULT NULL,
  `Notelp` varchar(50) DEFAULT NULL,
  `PHOTO` longblob,
  `COSTUM_1` varchar(50) DEFAULT NULL COMMENT 'eselon',
  `COSTUM_2` varchar(50) DEFAULT NULL COMMENT 'password',
  `COSTUM_3` varchar(50) DEFAULT NULL COMMENT 'pangkat',
  `COSTUM_4` varchar(50) DEFAULT NULL COMMENT 'golongan',
  `COSTUM_5` varchar(50) DEFAULT NULL COMMENT 'npwp',
  `COSTUM_6` varchar(50) DEFAULT NULL COMMENT 'passcetak',
  `COSTUM_7` varchar(50) DEFAULT NULL,
  `COSTUM_8` varchar(50) DEFAULT NULL,
  `COSTUM_9` varchar(50) DEFAULT NULL,
  `COSTUM_10` varchar(50) DEFAULT NULL,
  `COSTUM_11` varchar(50) DEFAULT NULL,
  `COSTUM_12` varchar(50) DEFAULT NULL,
  `COSTUM_13` varchar(50) DEFAULT NULL,
  `COSTUM_14` varchar(50) DEFAULT NULL,
  `COSTUM_15` varchar(50) DEFAULT NULL,
  `COSTUM_16` varchar(50) DEFAULT NULL,
  `BE_Active` varchar(50) DEFAULT NULL,
  `tgL_Keluar` varchar(50) DEFAULT NULL,
  `Alasan_Keluar` varchar(50) DEFAULT NULL,
  `Cat_Keluar` varchar(50) DEFAULT NULL,
  `Biokey` int(11) DEFAULT NULL,
  `SidikJari0_9000` longtext,
  `SidikJari1_9000` longtext,
  `SidikJari2_9000` longtext,
  `SidikJari3_9000` longtext,
  `SidikJari4_9000` longtext,
  `SidikJari5_9000` longtext,
  `SidikJari6_9000` longtext,
  `SidikJari7_9000` longtext,
  `SidikJari8_9000` longtext,
  `SidikJari9_9000` longtext,
  `Kartu_9000` longtext,
  `Password_9000` longtext,
  `Wajah_9000` longtext,
  `Privilage_9000` int(11) DEFAULT '0',
  `SidikJari0_8000` longblob,
  `SidikJari1_8000` longblob,
  `SidikJari2_8000` longblob,
  `Kartu_8000` longblob,
  `Password_8000` int(11) DEFAULT '0',
  `Wajah_8000` longblob,
  `Privilege_8000` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_sys`
--

CREATE TABLE IF NOT EXISTS `hr_sys` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NamaPerusahaan` varchar(255) DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `NoTelp` varchar(255) DEFAULT NULL,
  `Fax` varchar(255) DEFAULT NULL,
  `Logo` longblob,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `hr_unit`
--

CREATE TABLE IF NOT EXISTS `hr_unit` (
  `IdUnit` varchar(10) DEFAULT NULL,
  `Namaunit` varchar(50) DEFAULT NULL,
  `Nodelevel` int(11) DEFAULT '0',
  `anakunit` varchar(10) DEFAULT NULL,
  `DisUser` varchar(255) DEFAULT NULL,
  KEY `IdUnit` (`IdUnit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_anak`
--

CREATE TABLE IF NOT EXISTS `menu_anak` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Menu_Induk_Id` int(11) DEFAULT NULL,
  `Menu_Name` varchar(255) DEFAULT NULL,
  `Menu_Caption` varchar(255) DEFAULT NULL,
  KEY `Id` (`Id`),
  KEY `Menu_Induk_Id` (`Menu_Induk_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu_induk`
--

CREATE TABLE IF NOT EXISTS `menu_induk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Menu_Name` varchar(255) DEFAULT NULL,
  `Menu_Caption` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `mesininfo`
--

CREATE TABLE IF NOT EXISTS `mesininfo` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `namamesin` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `alamatip` varchar(16) COLLATE latin1_general_ci DEFAULT NULL,
  `port` int(8) DEFAULT '6008',
  `pwd` int(8) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_autoupload`
--

CREATE TABLE IF NOT EXISTS `m_autoupload` (
  `AutoID` int(11) NOT NULL,
  `Jam_1` varchar(255) DEFAULT NULL,
  `Jam_2` varchar(255) DEFAULT NULL,
  `Jam_3` varchar(255) DEFAULT NULL,
  `Jam_4` varchar(255) DEFAULT NULL,
  `menit` int(11) DEFAULT NULL,
  `chk1` int(11) DEFAULT '0',
  `chk2` int(11) DEFAULT '0',
  `chk3` int(11) DEFAULT '0',
  `chk4` int(11) DEFAULT '0',
  `optjw` int(11) DEFAULT '0',
  `optjam` int(11) DEFAULT '0',
  PRIMARY KEY (`AutoID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_mesin`
--

CREATE TABLE IF NOT EXISTS `m_mesin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NoMesin` int(11) DEFAULT NULL,
  `TipeMesin` varchar(255) DEFAULT NULL,
  `TipeKom` varchar(255) DEFAULT NULL,
  `AlamatIP` varchar(255) DEFAULT NULL,
  `PORT` int(11) DEFAULT NULL,
  `Password` int(11) DEFAULT NULL,
  `COM` int(11) DEFAULT NULL,
  `baudrate` int(11) DEFAULT NULL,
  `rt_sms` varchar(255) DEFAULT NULL,
  `rt_version` varchar(255) DEFAULT NULL,
  `Catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `pay_angs`
--

CREATE TABLE IF NOT EXISTS `pay_angs` (
  `KodePinjaman` varchar(255) DEFAULT NULL,
  `NIK` varchar(255) DEFAULT NULL,
  `Angs_ke` int(11) DEFAULT NULL,
  `NominalBayar` decimal(19,4) DEFAULT NULL,
  `TglBayar` varchar(255) DEFAULT NULL,
  `UserInput` varchar(255) DEFAULT NULL,
  `TglInput` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_aturan`
--

CREATE TABLE IF NOT EXISTS `pay_aturan` (
  `KodeAturan` varchar(255) DEFAULT NULL,
  `NamaAturan` varchar(255) DEFAULT NULL,
  `KodePendapatan` varchar(255) DEFAULT NULL,
  `NamaPendapatan` varchar(255) DEFAULT NULL,
  `KodePotongan` varchar(255) DEFAULT NULL,
  `NamaPotongan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_pendapatan`
--

CREATE TABLE IF NOT EXISTS `pay_pendapatan` (
  `KoPen` varchar(50) DEFAULT NULL,
  `KodeAturan` varchar(255) DEFAULT NULL,
  `Nama_Item` varchar(255) DEFAULT NULL,
  `Formula` int(11) DEFAULT NULL,
  `Nilai` decimal(19,4) DEFAULT '0.0000',
  `Periode` varchar(255) DEFAULT NULL,
  `parameter` varchar(255) DEFAULT NULL,
  `Operator` varchar(255) DEFAULT NULL,
  `Satuan` varchar(50) DEFAULT NULL,
  `NilaiOperator` int(11) DEFAULT '0',
  `NilaiHasil` decimal(19,4) DEFAULT '0.0000',
  `chkPersen` int(11) DEFAULT NULL,
  `ItemPendapatan` varchar(50) DEFAULT NULL,
  `chkaturanot` varchar(255) DEFAULT NULL,
  KEY `KodeAturan` (`KodeAturan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_pinjaman`
--

CREATE TABLE IF NOT EXISTS `pay_pinjaman` (
  `KodePinjaman` varchar(255) DEFAULT NULL,
  `Keterangan` varchar(255) DEFAULT NULL,
  `NIK` varchar(255) DEFAULT NULL,
  `NamaStaff` varchar(255) DEFAULT NULL,
  `TglPinjam` varchar(255) DEFAULT NULL,
  `PinjamanPokok` decimal(19,4) DEFAULT NULL,
  `Bunga` decimal(18,3) DEFAULT '0.000',
  `Nilaibunga` decimal(19,4) DEFAULT NULL,
  `TotalPinjaman` decimal(19,4) DEFAULT NULL,
  `masaAngsuran` int(11) DEFAULT NULL,
  `NilaiAngsuran` decimal(19,4) DEFAULT NULL,
  `AutoDebet` int(11) DEFAULT NULL,
  `Lunas` int(11) DEFAULT '0',
  `tglLunas` int(11) DEFAULT '0',
  `SaldoPinjaman` varchar(255) DEFAULT NULL,
  UNIQUE KEY `KodePinjaman` (`KodePinjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_potongan`
--

CREATE TABLE IF NOT EXISTS `pay_potongan` (
  `KoPot` varchar(50) DEFAULT NULL,
  `IDAturan` varchar(50) DEFAULT NULL,
  `Nama_Item` varchar(255) DEFAULT NULL,
  `Formula` int(11) DEFAULT NULL,
  `Nilai` decimal(19,4) DEFAULT '0.0000',
  `Periode` varchar(255) DEFAULT NULL,
  `parameter` varchar(255) DEFAULT NULL,
  `Operator` varchar(255) DEFAULT NULL,
  `Satuan` varchar(255) DEFAULT NULL,
  `NilaiOperator` int(11) DEFAULT '0',
  `NilaiHasil` decimal(19,4) DEFAULT '0.0000',
  `chkPersen` varchar(50) DEFAULT NULL,
  `ItemPendapatan` varchar(50) DEFAULT NULL,
  KEY `IDAturan` (`IDAturan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_premi`
--

CREATE TABLE IF NOT EXISTS `pay_premi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `JamLembur` decimal(18,3) DEFAULT '0.000',
  `HariKerja` decimal(18,3) DEFAULT '0.000',
  `HariOFF` decimal(18,3) DEFAULT '0.000',
  `HariLibur` decimal(18,3) DEFAULT '0.000',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pay_staffx`
--

CREATE TABLE IF NOT EXISTS `pay_staffx` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NIK` varchar(255) DEFAULT NULL,
  `FID` int(11) DEFAULT NULL,
  `KodeAturan` varchar(50) DEFAULT NULL,
  `NamaAturan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FID` (`FID`),
  KEY `KodeAturan` (`KodeAturan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `r_ot`
--

CREATE TABLE IF NOT EXISTS `r_ot` (
  `R_Id` int(11) NOT NULL AUTO_INCREMENT,
  `R_awal` int(11) DEFAULT '0',
  `R_Akhir` int(11) DEFAULT '0',
  `R_Hasil` int(11) DEFAULT '0',
  PRIMARY KEY (`R_Id`),
  KEY `R_Id` (`R_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `set_ot`
--

CREATE TABLE IF NOT EXISTS `set_ot` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tipeOT` varchar(255) DEFAULT NULL,
  `Op` varchar(255) DEFAULT NULL,
  `menit` int(11) DEFAULT NULL,
  `kali` decimal(18,3) DEFAULT '0.000',
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `sys_download`
--

CREATE TABLE IF NOT EXISTS `sys_download` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PolaRt` int(11) DEFAULT NULL,
  `cj1` varchar(255) DEFAULT NULL,
  `jam1` varchar(255) DEFAULT NULL,
  `cj2` varchar(255) DEFAULT NULL,
  `jam2` varchar(255) DEFAULT NULL,
  `cj3` varchar(255) DEFAULT NULL,
  `jam3` varchar(255) DEFAULT NULL,
  `cj4` varchar(255) DEFAULT NULL,
  `jam4` varchar(255) DEFAULT NULL,
  `ChkHapus` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `sys_sms`
--

CREATE TABLE IF NOT EXISTS `sys_sms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AturanKirim` varchar(255) DEFAULT NULL,
  `t_Fid` varchar(255) DEFAULT NULL,
  `t_Nama` varchar(255) DEFAULT NULL,
  `t_NIK` varchar(255) DEFAULT NULL,
  `t_Dept` varchar(255) DEFAULT NULL,
  `t_Jab` varchar(255) DEFAULT NULL,
  `F_Fid` varchar(255) DEFAULT NULL,
  `F_Nama` varchar(255) DEFAULT NULL,
  `F_NIK` varchar(255) DEFAULT NULL,
  `F_Dept` varchar(255) DEFAULT NULL,
  `F_Jab` varchar(255) DEFAULT NULL,
  `c_Fid` varchar(255) DEFAULT NULL,
  `c_Nama` varchar(255) DEFAULT NULL,
  `c_NIK` varchar(255) DEFAULT NULL,
  `c_Dept` varchar(255) DEFAULT NULL,
  `c_Jab` varchar(255) DEFAULT NULL,
  `c_kirimTotal` varchar(255) DEFAULT NULL,
  `NoTotal` varchar(255) DEFAULT NULL,
  `JamTotal` varchar(255) DEFAULT NULL,
  `c_no2` varchar(255) DEFAULT NULL,
  `No2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `F_Fid` (`F_Fid`),
  KEY `c_Fid` (`c_Fid`),
  KEY `t_Fid` (`t_Fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_info`
--

CREATE TABLE IF NOT EXISTS `sys_user_info` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_name` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `User_Grade` int(11) DEFAULT NULL,
  `MenuAkses` varchar(255) DEFAULT NULL,
  `deptAkses` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `ta_daftarijin`
--

CREATE TABLE IF NOT EXISTS `ta_daftarijin` (
  `Fid` int(11) DEFAULT NULL,
  `IdIjin` int(11) DEFAULT NULL,
  `TipeIjin` int(11) DEFAULT NULL,
  `TglIjin` varchar(255) DEFAULT NULL,
  `chklangsung` int(11) DEFAULT NULL,
  `JamAwal` varchar(255) DEFAULT NULL,
  `JamAkhir` varchar(255) DEFAULT NULL,
  `JmlMenit` varchar(255) DEFAULT NULL,
  `Alasan` varchar(255) DEFAULT NULL,
  `TglInput` varchar(255) DEFAULT NULL,
  `UserInput` varchar(255) DEFAULT NULL,
  `TahunIjin` varchar(255) DEFAULT NULL,
  KEY `Fid` (`Fid`),
  KEY `IdIjin` (`IdIjin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ta_harian`
--

CREATE TABLE IF NOT EXISTS `ta_harian` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FID` varchar(255) DEFAULT NULL,
  `Tanggal` varchar(255) DEFAULT NULL,
  `Jadwal` varchar(255) DEFAULT NULL,
  `JamMasuk` varchar(255) DEFAULT NULL,
  `stattelat` varchar(255) NOT NULL,
  `Log` varchar(255) DEFAULT NULL,
  `statkirim` varchar(255) DEFAULT NULL,
  KEY `Tanggal` (`Tanggal`),
  KEY `Id` (`Id`),
  KEY `FID` (`FID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ta_hari_libur`
--

CREATE TABLE IF NOT EXISTS `ta_hari_libur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_libur` varchar(50) DEFAULT NULL,
  `tgl_libur` varchar(255) DEFAULT NULL,
  `TpLIbur` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ta_jadwal_staffx`
--

CREATE TABLE IF NOT EXISTS `ta_jadwal_staffx` (
  `Fid` varchar(255) DEFAULT NULL,
  `NamaStaff` varchar(255) DEFAULT NULL,
  `Tanggal` varchar(255) DEFAULT NULL,
  `NoJadwal` varchar(255) DEFAULT NULL,
  `NoShift_1` varchar(255) DEFAULT NULL,
  `NoShift_2` varchar(255) DEFAULT NULL,
  `NoShift_3` varchar(255) DEFAULT NULL,
  `NoShift_4` varchar(255) DEFAULT NULL,
  `NoShift_5` varchar(255) DEFAULT NULL,
  `chk_gbng` varchar(255) DEFAULT NULL,
  KEY `Fid` (`Fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ta_log`
--

CREATE TABLE IF NOT EXISTS `ta_log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Mach_id` varchar(255) DEFAULT NULL,
  `Fid` varchar(255) DEFAULT NULL,
  `Nama_Staff` varchar(255) DEFAULT NULL,
  `Kondisi` varchar(255) DEFAULT NULL,
  `Verifikasi` varchar(255) DEFAULT NULL,
  `In_out` varchar(255) DEFAULT NULL,
  `Tanggal_Log` varchar(50) DEFAULT NULL,
  `Jam_Log` varchar(255) DEFAULT NULL,
  `tgl_input` varchar(255) DEFAULT NULL,
  `user_input` varchar(255) DEFAULT NULL,
  `TA_MarkSMS` int(11) DEFAULT '0',
  `Pilih` int(11) DEFAULT '0',
  `DateTime` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Fid` (`Fid`),
  KEY `Id` (`Id`),
  KEY `Mach_id` (`Mach_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=294373 ;

-- --------------------------------------------------------

--
-- Table structure for table `ta_shift`
--

CREATE TABLE IF NOT EXISTS `ta_shift` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Shift` varchar(255) DEFAULT NULL,
  `Jam_masuk` varchar(255) DEFAULT NULL,
  `Jam_keluar` varchar(255) DEFAULT NULL,
  `Awal_masuk` varchar(255) DEFAULT NULL,
  `Akhir_masuk` varchar(255) DEFAULT NULL,
  `Awal_keluar` varchar(255) DEFAULT NULL,
  `Akhir_keluar` varchar(255) DEFAULT NULL,
  `awal_lembur` varchar(255) DEFAULT NULL,
  `T_telat` varchar(255) DEFAULT NULL,
  `T_PC` varchar(255) DEFAULT NULL,
  `Hari_kerja` varchar(255) DEFAULT NULL,
  `menit_kerja` varchar(255) DEFAULT NULL,
  `Menit_lembur_awal` varchar(255) DEFAULT NULL,
  `Menit_lembur_akhir` varchar(255) DEFAULT NULL,
  `chk_lembur_awal` varchar(255) DEFAULT NULL,
  `chk_lembur_akhir` varchar(255) DEFAULT NULL,
  `chk_harus_masuk` varchar(255) DEFAULT NULL,
  `chk_harus_keluar` varchar(255) DEFAULT NULL,
  `chk_Jadwal_lembur` varchar(255) DEFAULT NULL,
  `chk_besok` int(11) DEFAULT NULL,
  `chk_ist1` int(11) DEFAULT NULL,
  `ist1_1` varchar(255) DEFAULT NULL,
  `ist1_2` varchar(255) DEFAULT NULL,
  `chk_ist2` int(11) DEFAULT NULL,
  `ist2_1` varchar(255) DEFAULT NULL,
  `ist2_2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `ta_sys`
--

CREATE TABLE IF NOT EXISTS `ta_sys` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TA_Record_Min` int(11) DEFAULT NULL,
  `chk_Lupa_Masuk` int(11) DEFAULT NULL,
  `chk_Lupa_Pulang` int(11) DEFAULT NULL,
  `Menit_Lupa_masuk` int(11) DEFAULT NULL,
  `Menit_Lupa_Pulang` int(11) DEFAULT NULL,
  `Hari_Istirahat` int(11) DEFAULT NULL,
  `Hari_Libur` int(11) DEFAULT NULL,
  `Hari_Lembur` int(11) DEFAULT NULL,
  `Fungsi_1` int(11) DEFAULT NULL,
  `Fungsi_2` int(11) DEFAULT NULL,
  `Fungsi_3` int(11) DEFAULT NULL,
  `Fungsi_4` int(11) DEFAULT NULL,
  `Fungsi_5` int(11) DEFAULT NULL,
  `Fungsi_bebas` int(11) DEFAULT NULL,
  `JmlIjin` int(11) DEFAULT '0',
  `Jam_Akhir` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ta_timetable`
--

CREATE TABLE IF NOT EXISTS `ta_timetable` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Jadwal` varchar(255) DEFAULT NULL,
  `Jadwal1` varchar(255) DEFAULT NULL,
  `jadwal2` varchar(255) DEFAULT NULL,
  `jadwal3` varchar(255) DEFAULT NULL,
  `jadwal4` varchar(255) DEFAULT NULL,
  `jadwal5` varchar(255) DEFAULT NULL,
  `chk_gabung` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `ta_tipe_ijin`
--

CREATE TABLE IF NOT EXISTS `ta_tipe_ijin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipe_ijin` varchar(50) DEFAULT NULL,
  `Be_del` varchar(50) DEFAULT NULL,
  KEY `Id` (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `FID` char(5) NOT NULL,
  `NIP` char(20) NOT NULL,
  `ID_OPD` char(3) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_satudata`
--

CREATE TABLE IF NOT EXISTS `tbl_admin_satudata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NIP` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apel_pagi`
--

CREATE TABLE IF NOT EXISTS `tbl_apel_pagi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(222) NOT NULL,
  `tanggal` date NOT NULL,
  `hukuman` int(3) NOT NULL,
  `NIP_REFF` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apel_pagi_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_apel_pagi_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NIP` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apel_pagi_nip`
--

CREATE TABLE IF NOT EXISTS `tbl_apel_pagi_nip` (
  `id_apel` int(11) NOT NULL,
  `NIP` varchar(55) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bendahara_gaji`
--

CREATE TABLE IF NOT EXISTS `tbl_bendahara_gaji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_OPD` int(11) NOT NULL,
  `FID` int(6) NOT NULL,
  `NIP` varchar(222) NOT NULL,
  `NAMA` varchar(222) NOT NULL,
  `GOLONGAN` varchar(222) NOT NULL,
  `PANGKAT` varchar(222) NOT NULL,
  `JABATAN` varchar(222) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bulan_puasa`
--

CREATE TABLE IF NOT EXISTS `tbl_bulan_puasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuti_lain`
--

CREATE TABLE IF NOT EXISTS `tbl_cuti_lain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `NIK` varchar(55) NOT NULL,
  `status` enum('pending','approve','cancel') NOT NULL,
  `NIK_REF` varchar(55) NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keterangan` text NOT NULL,
  `FID` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=770 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuti_sakit`
--

CREATE TABLE IF NOT EXISTS `tbl_cuti_sakit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `NIK` varchar(55) NOT NULL,
  `status` enum('pending','approve','cancel') NOT NULL,
  `NIK_REF` varchar(55) NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keterangan` text NOT NULL,
  `FID` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1180 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuti_tahunan`
--

CREATE TABLE IF NOT EXISTS `tbl_cuti_tahunan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `NIK` varchar(55) NOT NULL,
  `NIK_REF` varchar(55) NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('pending','approve','cancel') NOT NULL,
  `FID` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47231 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dinas_luar`
--

CREATE TABLE IF NOT EXISTS `tbl_dinas_luar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `NIK` varchar(55) NOT NULL,
  `NIK_REF` varchar(55) NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('pending','approve','cancel') NOT NULL,
  `FID` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68805 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_libur`
--

CREATE TABLE IF NOT EXISTS `tbl_libur` (
  `id_libur` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_libur` date NOT NULL,
  `desc_libur` varchar(222) NOT NULL,
  PRIMARY KEY (`id_libur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_log_admin` (
  `id_log` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `referensi` int(11) NOT NULL,
  `aktivitas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pimpinan`
--

CREATE TABLE IF NOT EXISTS `tbl_pimpinan` (
  `id_pimpinan` int(11) NOT NULL AUTO_INCREMENT,
  `FID` char(5) NOT NULL,
  `NIP` char(20) NOT NULL,
  `ID_OPD` char(3) NOT NULL,
  PRIMARY KEY (`id_pimpinan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_struktur`
--

CREATE TABLE IF NOT EXISTS `tbl_struktur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_OPD` char(2) NOT NULL,
  `OPD` varchar(222) NOT NULL,
  `ID_ESELON` char(2) NOT NULL,
  `ESELON` varchar(222) NOT NULL,
  `TPP` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_ijin_keterangan`
--

CREATE TABLE IF NOT EXISTS `tbl_surat_ijin_keterangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NIK` varchar(222) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('pending','approve','cancel') NOT NULL,
  `keterangan` text NOT NULL,
  `FID` varchar(55) NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `url_upload` text NOT NULL,
  `NIK_REF` varchar(55) NOT NULL,
  `masuk_pulang` enum('masuk','pulang') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14160 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_sakit`
--

CREATE TABLE IF NOT EXISTS `tbl_surat_sakit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NIK` varchar(222) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('pending','approve','cancel') NOT NULL,
  `keterangan` text NOT NULL,
  `FID` varchar(55) NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `url_upload` text NOT NULL,
  `NIK_REF` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2356 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vote`
--

CREATE TABLE IF NOT EXISTS `tbl_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` char(2) NOT NULL,
  `tahun` char(4) NOT NULL,
  `ID_OPD` int(5) NOT NULL,
  `NAMA` char(60) NOT NULL,
  `NIP` char(50) NOT NULL,
  `JABATAN` varchar(222) NOT NULL,
  `PANGKAT` char(50) NOT NULL,
  `GOL` char(10) NOT NULL,
  `CAPAIAN_SKP` char(5) NOT NULL,
  `CAPAIAN_BULANAN` char(5) NOT NULL,
  `CAPAIAN_RATA_RATA` char(5) NOT NULL,
  `POTONGAN_ABSEN` char(5) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=286898 ;

-- --------------------------------------------------------

--
-- Table structure for table `temp_log`
--

CREATE TABLE IF NOT EXISTS `temp_log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Mach_id` varchar(255) DEFAULT NULL,
  `Fid` varchar(255) DEFAULT NULL,
  `Nama_Staff` varchar(255) DEFAULT NULL,
  `Kondisi` varchar(255) DEFAULT NULL,
  `Verifikasi` varchar(255) DEFAULT NULL,
  `In_out` varchar(255) DEFAULT NULL,
  `Tanggal_Log` varchar(50) DEFAULT NULL,
  `Jam_Log` varchar(255) DEFAULT NULL,
  `tgl_input` varchar(255) DEFAULT NULL,
  `user_input` varchar(255) DEFAULT NULL,
  `TA_MarkSMS` int(11) DEFAULT '0',
  `Pilih` int(11) DEFAULT '0',
  `DateTime` varchar(255) NOT NULL,
  KEY `Fid` (`Fid`),
  KEY `Id` (`Id`),
  KEY `Mach_id` (`Mach_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `v_absen_hari_ini`
--

CREATE TABLE IF NOT EXISTS `v_absen_hari_ini` (
  `Fid` varchar(11) DEFAULT NULL,
  `Nama` varchar(50) DEFAULT NULL,
  `Nik` varchar(50) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `jam_masuk` varchar(255) DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `jam_keluar` varchar(255) DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `telat_masuk` decimal(13,4) DEFAULT NULL,
  `cepat_pulang` decimal(13,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_absen_kemarin`
--

CREATE TABLE IF NOT EXISTS `v_absen_kemarin` (
  `Fid` varchar(11) DEFAULT NULL,
  `Nama` varchar(50) DEFAULT NULL,
  `Nik` varchar(50) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `jam_masuk` varchar(255) DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `jam_keluar` varchar(255) DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `telat_masuk` decimal(13,4) DEFAULT NULL,
  `cepat_pulang` decimal(13,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_absen_sekarang`
--

CREATE TABLE IF NOT EXISTS `v_absen_sekarang` (
  `Fid` varchar(11) DEFAULT NULL,
  `Nama` varchar(50) DEFAULT NULL,
  `Nik` varchar(50) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `jam_masuk` varchar(255) DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `jam_keluar` varchar(255) DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `telat_masuk` decimal(13,4) DEFAULT NULL,
  `cepat_pulang` decimal(13,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_keluar_kemarin`
--

CREATE TABLE IF NOT EXISTS `v_keluar_kemarin` (
  `Fid` varchar(255) DEFAULT NULL,
  `Nama_Staff` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `jam` varchar(255) DEFAULT NULL,
  `MAX(waktu)` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_keluar_sebulan`
--

CREATE TABLE IF NOT EXISTS `v_keluar_sebulan` (
  `Fid` varchar(255) DEFAULT NULL,
  `Nama_Staff` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `jam` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_masuk_kemarin`
--

CREATE TABLE IF NOT EXISTS `v_masuk_kemarin` (
  `Fid` varchar(255) DEFAULT NULL,
  `Nama_Staff` varchar(255) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `jam_masuk` varchar(255) DEFAULT NULL,
  `MIN(waktu_masuk)` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `v_masuk_sebulan`
--

CREATE TABLE IF NOT EXISTS `v_masuk_sebulan` (
  `Fid` varchar(255) DEFAULT NULL,
  `Nama_Staff` varchar(255) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `jam_masuk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tbl_opd`
--
CREATE TABLE IF NOT EXISTS `v_tbl_opd` (
`id` int(11)
,`ID_OPD` char(2)
,`OPD` varchar(222)
,`ID_ESELON` char(2)
,`ESELON` varchar(222)
,`TPP` double
);
-- --------------------------------------------------------

--
-- Structure for view `v_tbl_opd`
--
DROP TABLE IF EXISTS `v_tbl_opd`;

CREATE ALGORITHM=UNDEFINED DEFINER=`bahanpe`@`%` SQL SECURITY DEFINER VIEW `v_tbl_opd` AS select `tbl_struktur`.`id` AS `id`,`tbl_struktur`.`ID_OPD` AS `ID_OPD`,`tbl_struktur`.`OPD` AS `OPD`,`tbl_struktur`.`ID_ESELON` AS `ID_ESELON`,`tbl_struktur`.`ESELON` AS `ESELON`,`tbl_struktur`.`TPP` AS `TPP` from `tbl_struktur` group by `tbl_struktur`.`ID_OPD`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
