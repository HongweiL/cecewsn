#Introduction
DECO3801 project

#####Authors:
Hongwei Li
Jingwei Wang
Kaite Zhu
Qi Shao
Youwen Mao
Yuchi Zhang

CECEWSN is web based application that allows scientific researchers especially environmental chemists to upload HRMS data to improve the speed of calculation on state-of-the art algorithms; archiving and storage; and collaboration with other environmental chemists. More importantly, it will also be used as a platform for interpretation and visualisation of chemical statistics on different meta-data. The system aims to benefit general environmental monitoring and discovery of Chemicals of Emerging Concern.

The product development cycle from Team Anonymous, which consists of two major components: proposal and build. During the whole period of the product development cycle, Team Anonymous collaborated with clients to design and build a functional web
interface. Detailed development problems and corresponding solutions will also be included into the reporting, including a deployment/installation manual, source code walkthrough and an updated system architecture.

#Deployment/Installation Manual
##1. Environment
###1.1 Program for Web Hosting
-     Apache HTTP Server
-     PHP >= 7.1.3
-     MySQL

###1.2. Configuration of Program for Web Hosting
-     Give Apache user sudo permission.
-     Create a database called “cecewsn” inside of mysql

###1.3. Program for Processing
-     Anaconda 3 for Python 3.6
-     MATLAB Runtime Engine

###1.4. Configuration of Program for Processing

####1.4.1. Installation of Anaconda 3
1.     Got to https://www.anaconda.com/download/#linux
2.     Right click on the 64-Bit (x86) Installer (622 MB) link and select “Copy Link Location”  from the drop down.
3.     Enter command in console: $sudo curl -O
4.     https://repo.anaconda.com/archive/Anaconda3-5.2.0-Linux-x86_64.sh                      Note that the the address to “curl” is pasted from what was copied in step 4b.
5.     Command: $bash Anaconda3-5.2.0-Linux-x86_64.sh
6.     Press enter a few times, after reading and when prompted, command: $ yes
7.     Press enter
8.     Answer “yes” to prompt
9.     Answer “no” if prompt to install VSCode


####1.4.2. Installation of MATLAB Runtime Engine
1.     Go to https://www.mathworks.com/products/compiler/matlab-runtime.html

2.     Right click on the R2017b Linux 64-bit hyperlink: select “Copy link address”.

3.     In the terminal - the EC2 ubuntu session - enter command 
```bash
$ sudo curl -O [PASTE]
```
		1. Where, [PASTE] is the copied link address from the previous step 5b.
		2. Note that -O is the big “O” letter not the little “o” letter.

4.     unzip:
		1.     $ sudo apt-get install unzip
		2.     $ mkdir install_runtime
		3.     $ mv MCR_R2017b_glnxa64_installer.zip install_runtime
		4.     $ cd install_runtime
		5.     $ unzip MCR_R2017b_glnxa64_installer.zip

5.    Execute installation:
```bash
$ sudo ./install -mode silent -agreeToLicense yes
```
        Update environment variable LD_LIBRARY_PATH (be careful)
        Go to home:
```bash
$ cd
```
        Go to start-up script
        1.              Be careful...
        2.             $ vim .bashrc
        3.             Go to the very bottom of the file in vim (press down key)
        4.             Press “i” for insert mode
        5.             Paste the following code at the bottom of the .bashrc file:
```bash
$ export LD_LIBRARY_PATH=/usr/local/MATLAB/MATLAB_Runtime/v93/runtime/glnxa64:/usr/local/MATLAB/MATLAB_Runtime/v93/bin/glnxa64:/usr/local/MATLAB/MATLAB_Runtime/v93/sys/opengl/lib/glnxa64/
```
        6.              Press “Esc” and then “:wq!” to save and exit program file.


####1.4.3. Installation of dependency
    $ sudo apt-get install freeglut3-dev build-essential libx11-dev libxmu-dev libxi-dev       libgl1-mesa-glx libglu1-mesa libglu1-mesa-dev libglfw3-dev libgles2-mesa-dev


####1.4.4. Setup and Install compiled python packages
1. Navigate to compiled packages repository
    i. $ cd qaehs_code/compiled
	
2. Install each necessary package. E.g.
```bash
$ cd ImportDeconvAlpha
$ cd for_redistribution_files_only
$ python setup.py install
```

##2. AWS S3 Setup
 ###2.1. Bucket
1. Create a bucket called “cecewsn”.
2. Add flowing bucket policy to this bucket

```php
{
    "Version": "2008-10-17",
    "Id": "Policy1335892530063",
    "Statement": [
        {
            "Sid": "Stmt1335892150622",
            "Effect": "Allow",
            "Principal": {
                "AWS": "arn:aws:iam::386209384616:root"
            },
            "Action": [
                "s3:GetBucketAcl",
                "s3:GetBucketPolicy"
            ],
            "Resource": "arn:aws:s3:::cecewsn"
        },
        {
            "Sid": "Stmt1335892526596",
            "Effect": "Allow",
            "Principal": {
                "AWS": "*"
            },
            "Action": [
                "s3:PutObject",
                "s3:PutObjectAcl",
                "s3:DeleteObject"
            ],
            "Resource": "arn:aws:s3:::cecewsn/*"
        }
    ]
}

```
###2.2. Amazon Cognito identity pools
1. Open Amazon Cognito console
2. Click Manage Identity Pools
3. Create a new identity pool
4. Go to the identity pool that just created
5. Click Sample Code at left side.
6. Choose Javascript as platform
7. Get IdentityPoolId


##2. Product code Setup
  ####2.1. Code reconstruction
1. Get the laravel 5.6 framework from https://github.com/laravel-shift/laravel-5.6

2. Get CECEWSN source code from https://source.eait.uq.edu.au/gitlist/deco3801-teamanonymous/

3. Copy and replace all CECEWSN sources files into laravel 5.6 framework folder.

4. Download AWS SDK for PHP from https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/getting-started_installation.html and put it into “/app/API/aws/”.

5. After that, the correct path for aws-autoloader.php should be “/app/API/aws/aws-autoloader.php”.

6. Download MassBank_matlab.mat from google drive and put it inside “/public/algorithms/”.

7. Configure .env file in CECEWSN root directory. 
```bash
$vim .env
```

8. Enter your DB_DATABASE, DB_USERNAME, DB_PASSWORD, AWS_KEY, AWS_SECRET and AWS_IdentityPoolId

        DB_DATABASE = cecewsn
        DB_USERNAME // username for mysql access
		DB_PASSWORD // password for mysql access
		AWS_KEY // AWS S3 key
		AWS_SECRET // AWS S3 secret key
		AWS_IdentityPoolId // Amazon Cognito Identity Pool ID
		
####2.2. Database & Auto-running program
1.     Use laravel built-in method to create database tables.
```bash
$ cd path/to/CECEWSN/
$ php artisan migrate 
```
2.     Schedule processing program
```bash
$ crontab -e
```
3.     Add flowing line at the end of file
    `* * * * * root /usr/bin/php path/to/sources/files/artisan schedule:run >> /dev/null 2>&1`

4.     Restart the service
```bash
$ sudo service cron restart
```
5.     Check if program schedule correctly
```bash
$ cd path/to/CECEWSN/
$ php artisan schedule:run
Running scheduled command: processing
```
