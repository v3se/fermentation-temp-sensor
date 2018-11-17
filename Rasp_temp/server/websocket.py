import asyncio
import time
import websockets
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="",
  passwd="",
  database=""
)

mycursor = mydb.cursor()

async def recv_tmp(websocket, path):
                temp = await websocket.recv()
                f = open('/var/www/html/temps.txt','w')
                f.write(temp + '\n')
		f.close()
                temp_c,temp_f = temp.split(",")
                mycursor.execute("INSERT INTO sensor_data (temp_c, temp_f, idbatch) VALUES (" + temp_c + "," + temp_f + ", 8)")
                mydb.commit()
                time.sleep( 10 )
                #print("< {}".format(temp))
                #f = open('/var/www/html/temps_appended.txt','a')
                #f.write("{},{} \n".format(time.time(),temp))
		
        	  # greeting = "Hello {}!".format(name)
   # await websocket.send(greeting)
   # print("> {}".format(greeting))
start_server = websockets.serve(recv_tmp, '172.31.40.77', 8765)

asyncio.get_event_loop().run_until_complete(start_server)
asyncio.get_event_loop().run_forever()
