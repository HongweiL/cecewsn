import LibrarySearch_v1
import sys
from os.path import join
data_path = sys.argv[1]
path_MB = join(data_path, 'MassBank_matlab.mat')
path_adducts = join(data_path, 'tmp', 'adducts', sys.argv[2])
path_to_spec = join(data_path, 'tmp', 'deconv')
output_ulsa = join(data_path, 'tmp', 'ULSA')

source = 'ESI'
mode = 'POSITIVE'

l = LibrarySearch_v1.initialize()
l.LibrarySearch_v1(path_MB, source, mode, path_adducts, path_to_spec, output_ulsa, nargout=0)
l.terminate()
