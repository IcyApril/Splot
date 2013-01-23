Splot.cc
==============

A file sharing website script which uses Amazon S3, comes with legal notices and other details.
--------------

- Working demo http://splot.cc (for now!)
- My code is licensed under CC BY-NC-SA - http://creativecommons.org/licenses/by-nc-sa/3.0/
- All other code is distributed under their own respective licenses.


What you need to tweak to get it running
--------------
Sign up for AWS S3 and create an S3 bucket named Splot.cc (if you choose a different name enter it into the index.php file)
Create a new MySQL database (e.g. named splot).
Edit _src/php/connect.php to include your MySQL database details and your S3 keys.
Make other customisations.
