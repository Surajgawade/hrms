#!/bin/sh
cd /var/www/html/hrms/ResumeParser/ResumeTransducer/
java -cp 'bin/*:../GATEFiles/lib/*:../GATEFiles/bin/gate.jar:lib/*' code4goal.antony.resumeparser.ResumeParserProgram UnitTests/$1 /var/www/html/hrms/test/$2
#echo 0 sudo chmod 777 /var/www/html/test/Sebastin4.txt


