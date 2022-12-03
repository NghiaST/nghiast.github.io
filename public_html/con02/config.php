<?php
	//Tên kỳ thi
	$contestName = "Trường THPT Chuyên Bình Long thi VOI 2022 :>"; 
	//Mô tả kỳ thi
	$description = "Quyết tâm vàng VOI 2022: <a href='https://mail.google.com/mail/u/0/#inbox/'> Gmail</a> - 
						  <a href='https://www.facebook.com/'> Facebook</a> - 
						  <a href='https://codeforces.com/'> Codeforces</a> - 
						  <a href='https://cses.fi/'> CSES</a> - 
						  <a href='https://oj.vnoi.info/'> VNOJ</a>";
	//footer
	$footer = "Themis Web CBL - Trình chấm trên web";
	//Thư mục chưa đề (định dạng pdf, jpg hoặc zip)
	$problemsDir = "B_De_Bai";
	//Tên file đề tổng hợp
	$codeDir = "C_Code_Tham_Khao";
	//Thư mục chứa test
	$examTestDir = "C_Test_Mau";
	//Tên file test tổng hợp
	$examTestDir = "C_Test_Mau";
	//Thư mục lưu bài làm trực tuyến của học sinh
	$uploadDir = "A_HS_Task";
	//Thư mục chứa file logs
	$logsDir = "A_HS_Task\\logs";
	//Thời gian bắt đầu kỳ thi (theo định dạng bên dưới)
	$startTime = date_create("2019-03-18 15:01:00",timezone_open("Asia/Bangkok")); //YYYY-MM-DD HH:MM:SS
	//Thời gian làm bài - (đặt 0: không giới hạn)
	$duringTime = 0;
	//1: Công bố kết quả sau khi chấm, 0: không công bố.
	$publish = 1;
