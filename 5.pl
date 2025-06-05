#!C:/Strawberry/perl/bin/perl.exe

use strict;
use warnings;
use CGI qw(:standard);
use CGI::Carp qw(fatalsToBrowser);
use DBI;

# Get form data
my $nm  = param('name') || '';
my $age = param('age') || 0;

# SQLite connection (creates file if it doesn't exist)
my $db = DBI->connect("dbi:SQLite:dbname=info.db", "", "", {
    RaiseError => 1,
    AutoCommit => 1
}) or die "SQLite connect failed: $DBI::errstr";

# Create table if not exists
$db->do("CREATE TABLE IF NOT EXISTS info (name TEXT, age INTEGER)");

# Insert data
my $insert_q = $db->prepare("INSERT INTO info (name, age) VALUES (?, ?)");
$insert_q->execute($nm, $age);

# Select data
my $select_q = $db->prepare("SELECT name, age FROM info");
$select_q->execute();

# Output HTML
print header();
print start_html("Database Contents");
print "<h2>Current Contents of the 'info' Table</h2>";
print "<table border='1'><tr><th>Name</th><th>Age</th></tr>";

while (my @row = $select_q->fetchrow_array) {
    print "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
}

print "</table>";
print end_html;

# Clean up
$insert_q->finish;
$select_q->finish;
$db->disconnect;
