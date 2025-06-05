#!C:/xampp/perl/bin/perl.exe
use strict;
use warnings;
use CGI qw(:standard);

print header(-type => "text/html", -Refresh => "1");

my ($sec, $min, $hour) = (localtime())[0,1,2];

print start_html("Current Server Time");

print br(), "The current server time is $hour:$min:$sec";
print br(), "In words, the time is - $hour hours, $min minutes and $sec seconds";

print end_html;
