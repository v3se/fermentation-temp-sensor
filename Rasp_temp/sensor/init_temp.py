import subprocess
from datetime import datetime
import time

connected = False

time.sleep( 5 )
with open("/home/pi/connected.log", mode='a') as file:
    		file.write(str(datetime.now()) + " Script has been started...\n")

while connected == False:
	time.sleep( 5 )
	ps = subprocess.Popen(['/sbin/iwconfig'], stdout=subprocess.PIPE, stderr=subprocess.STDOUT)
	try:
	    output = subprocess.check_output(('grep', 'ESSID'), stdin=ps.stdout)
	    connected = True
	    with open("/home/pi/connected.log", mode='a') as file:
    		file.write(str(datetime.now()) + " The sensor is connected to wifi " + str(output) + " - Trying to send temperature data using send_temp.py \n")
	    subprocess.check_call(["python3", "/home/pi/send_temp.py"])
	    

	except subprocess.CalledProcessError:
	    # grep did not match any lines
	    connected = False
	    with open("/home/pi/connected.log", mode='a') as file:
    		file.write(str(datetime.now()) + " Connection lost or the send_temp.py has crashed... - Trying to reconnect in 5 seconds\n")
