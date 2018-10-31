#!/bin/bash
export PATH="/home/ubuntu/anaconda3/bin:$PATH"
export LD_LIBRARY_PATH="/usr/local/MATLAB/MATLAB_Runtime/v93/runtime/glnxa64:/usr/local/MATLAB/MATLAB_Runtime/v93/bin/glnxa64:/usr/local/MATLAB/MATLAB_Runtime/v93/sys/opengl/lib/glnxa64/"
python /var/www/deco3801-teamanonymous/public/algorithms/combine.py $1 $2 $3 $4 $5