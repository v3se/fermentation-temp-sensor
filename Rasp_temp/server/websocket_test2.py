import asyncio
import time
import websockets

async def recv_tmp(websocket, path):
                temp = await websocket.recv()
                f = open('/var/www/html/temps.txt','w')
                f.write(temp + '\n')
                #print("< {}".format(temp))
                #f = open('/var/www/html/temps_appended.txt','a')
                #f.write("{},{} \n".format(time.time(),temp))
		
        	  # greeting = "Hello {}!".format(name)
   # await websocket.send(greeting)
   # print("> {}".format(greeting))
start_server = websockets.serve(recv_tmp, '172.31.40.77', 8765)

asyncio.get_event_loop().run_until_complete(start_server)
asyncio.get_event_loop().run_forever()
