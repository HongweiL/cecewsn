import ImportDeconv_v1
import sys
from os.path import join
data_path = sys.argv[1]
target_path = join(data_path, sys.argv[2])
path_low = join(data_path, "Low_Energy")
path_high = join(data_path, "High_Energy")
output_deconv = join(data_path, "deconv")
param = join(data_path, "config.txt")
file = open(param, 'r')
d_set = list(map(float, file.readline().split("\n")[0].split("=")))
file.close()
d = ImportDeconv_v1.initialize()
d.ImportDeconv_v1(d_set, target_path, path_low, path_high, output_deconv, nargout=0)
d.terminate()
