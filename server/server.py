'''
THIS PROGRAM RECEIVES A POST-REQUEST FROM ESP8266 BOARD 
CONTAINING A TAGID - WHEN SOMEONE PASSES A CARD 
ON THE RFID SENSOR - AND AN APIKEY VALIDATING THE 
PROCEDURE (SECURITY STEP).

SO IF THE APIKEY CHECKS, THE PROGRAM WILL SEND THE TAGID 
TO THE PHP SERVER, AND IT WILL RESPOND AUTHORIZING (1) OR
UNAUTHORIZING (0) THE ACCESS.

THE PROGRAM WILL RESPOND BACK TO THE ESP8266 AN HTTP-CODE
EQUIVALENT TO THE AUTHORIZATION (200 OR 401).

AUTHOR: RAFAEL M. ESCHER
FEDERAL UNIVERSITY OF RIO GRANDE
FURG
RIO GRANDE DO SUL
BRASIL

'''

import socketserver
import json
from http.server import SimpleHTTPRequestHandler

# python-php connection
import socket
import urllib.request
import urllib.parse
import time

# php server url
url = 'http://127.0.0.1/Door_Surveillance/passa_cartao.php'

PORT = 8091

class myHandler(SimpleHTTPRequestHandler):

    def do_GET(self):
        ''' INCOMPLETE - NOT USED '''

        '''
        # receive tagID from ESP8266
        print ("tagID: ")
        tagID = self.path
        print (tagID)

        content_length = int(self.headers['Content-Length']) # <--- Gets the size of data
        post_data = self.rfile.read(content_length) # <--- Gets the data itself

        print(post_data)
        
        
        # convert to json and then encode
        values = {'tagID' : tagID}
        data = urllib.parse.urlencode(values)
        
        # POST requires the data to be bytes
        data = data.encode('ascii') 

        # sends post-request with tagID to php server, and receives response from php server
        req = urllib.request.Request(url, data)
        with urllib.request.urlopen(req) as response:
            response = response.read().decode() # answer

        # set http response code (200 OK; 404 not found etc)
        http_resp = 404
        if (response == '1'): # access authorized
            http_resp = 200
        if (response == '0'): # access unauthorized
            http_resp = 401 
        self.send_response(http_resp)
        self.end_headers()

        # Sends message back to ESP8266
        self.wfile.write(bytes(response, "utf-8"))'''
        return
    
    def do_POST(self):

        # receive tagID from ESP8266
        content_length = int(self.headers['Content-Length']) # <--- Gets the size of data
        post_data = json.loads(self.rfile.read(content_length).decode("utf-8")) # <--- Gets the data itself

        tagID = post_data["tagID"]
        apiKEY = post_data["apiKEY"]

        # checks if the esp8266 was not cloned
        if (apiKEY == "b79e0ad612c6b94c2f956036a149e5c0"):
            # convert to json and then encode
            values = {'tagID' : tagID}
            data = urllib.parse.urlencode(values)
            
            # POST requires the data to be bytes
            data = data.encode('ascii') 

            # sends post-request with tagID to php server, and receives response
            req = urllib.request.Request(url, data)
            with urllib.request.urlopen(req) as response:
                response = response.read().decode() # answer

            # set http response code (200 OK; 404 not found etc)
            http_resp = 404
            if (response == '1'): # access authorized
                http_resp = 200
            if (response == '0'): # access unauthorized
                http_resp = 401
        else:
            http_resp = 401 # access unauthorized

        self.send_response(http_resp)
        self.end_headers()

        # Sends message back to ESP8266
        self.wfile.write(bytes(response, "utf-8"))
        return

try:

    server = socketserver.TCPServer(("", PORT), myHandler)
    print("iniciado")
    server.serve_forever()

except KeyboardInterrupt:
    server.socket.close()
