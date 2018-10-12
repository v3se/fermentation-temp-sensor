import websockets
import os
import glob
import time
import asyncio
from datetime import datetime
 
os.system('modprobe w1-gpio')
os.system('modprobe w1-therm')
remote_server = "ec2-18-195-162-116.eu-central-1.compute.amazonaws.com" #remote server url or IP address
 
base_dir = '/sys/bus/w1/devices/'
device_folder = glob.glob(base_dir + '28*')[0]
device_file = device_folder + '/w1_slave'
 
def read_temp_raw():
    f = open(device_file, 'r')
    lines = f.readlines()
    f.close()
    return lines
 
def read_temp():
    lines = read_temp_raw()
    while lines[0].strip()[-3:] != 'YES':
        time.sleep(0.2)
        lines = read_temp_raw()
    equals_pos = lines[1].find('t=')
    if equals_pos != -1:
        temp_string = lines[1][equals_pos+2:]
        temp_c = round(float(temp_string) / 1000.0, 2)
        temp_f = round(temp_c * 9.0 / 5.0 + 32.0, 2)
        return temp_c,temp_f


async def send_tmp():

    printed = False

    while True:
        
        try:
            ws_url = 'ws://'+ remote_server + ':8765'
            async with websockets.connect(ws_url) as websocket:
                temp = str(read_temp())
                for ch in ['(',')',' ']:
                    if ch in temp:
                        temp = temp.replace(ch, "")
                await websocket.send(temp)
                if printed == False:
                    with open("/home/pi/connected.log", mode='a') as file:
                        file.write(str(datetime.now()) + " Sensor is now connected to " + ws_url + "\n")
                        printed = True

               # print("> {}".format(temp))- this is for troubleshooting
        except:
            with open("/home/pi/connected.log", mode='a') as file:
                file.write(str(datetime.now()) + " Cannot connect to the remote server at " + ws_url + "\n")
                raise ValueError('Cannot connect to the remote server...')
            

asyncio.get_event_loop().run_until_complete(send_tmp())

            
#asyncio.get_event_loop().run_until_complete(send_tmp())
#asyncio.get_event_loop().run_forever()
        #greeting = await websocket.recv()
        #print("< {}".format(greeting))

#asyncio.get_event_loop().run_until_complete(send_tmp())
#asyncio.get_event_loop().run_forever()


	
