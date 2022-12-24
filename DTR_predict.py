import sys
import pandas as pd
import datetime
from bs4 import BeautifulSoup
import pickle
import requests, json 
import numpy as np

# print ('Number of arguments:', len(sys.argv), 'arguments.')
# print ('Argument List:', str(sys.argv))

with open('model_dtr', 'rb') as f:
    DTR = pickle.load(f)


    LuasLahan = float['LuasLahan'];
    JumlahBibit = float['JumlahBibit'];
    JumlahPakan = float['JumlahPakan'];

    hitung = np.array([[LuasLahan,JumlahBibit,JumlahPakan]])
    
    prediction = DTR.predict(hitung)
    hasil_pred = round(prediction[0], 2)

print (prediction)