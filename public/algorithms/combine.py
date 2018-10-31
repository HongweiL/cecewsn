import DeconvLibrarySearch_v1
import sys
from os.path import join
data_path = sys.argv[1]
target_path = join(data_path, 'tmp', sys.argv[2])
path_low = join(data_path, 'tmp', "Low_Energy")
path_high = join(data_path, 'tmp',"High_Energy")
output_deconv = join(data_path, 'tmp', "deconv")
param = join(data_path, 'tmp', "config.txt")
path_MB = join(data_path, 'MassBank_matlab.mat')
path_adducts = join(data_path, 'tmp', 'adducts', sys.argv[3])
output_ulsa = join(data_path, 'tmp', 'ULSA')
output_deconv = join(data_path, 'tmp', 'deconv')
file = open(param, 'r')
d_set = list(map(float, file.readline().split("\n")[0].split("=")))
file.close()
mode = sys.argv[4]
source = sys.argv[5]
dl = DeconvLibrarySearch_v1.initialize()
dl.DeconvLibrarySearch_v1(d_set, target_path, path_low, path_high, path_MB, source, mode, path_adducts, output_ulsa, output_deconv, nargout=0)
dl.terminate()
