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

        # receive tagID from ESP8266
        print ("tagID: ")
        tagID = self.path
        print (tagID)

        content_length = int(self.headers['Content-Length']) # <--- Gets the size of data
        post_data = self.rfile.read(content_length) # <--- Gets the data itself

        print(post_data)
        
        '''
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
        self.wfile.write(bytes(response, "utf-8"))
        return

try:

    server = socketserver.TCPServer(("", PORT), myHandler)
    print("iniciado")
    server.serve_forever()

except KeyboardInterrupt:
    server.socket.close()
