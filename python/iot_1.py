import paho.mqtt.client as mqttP


def on_connect(mqttc,userdata,flag,rc):
    print ("connected rc:"+str(rc))
    print ("userdata :"+ str(userdata))

#ee088bb0aa6864d900d5405bb46d9d4df160bedc
def on_subscribe(client, userdata, mid, gqos):
    print('Subscribed: ' + str(mid))

def on_publish(client, userdata, mid):
    print('publish ' + str(mid))
    print('publish ' + str(userdata))




mqttc=mqttP.Client(userdata="iot server", protocol=mqttP.MQTTv311)
mqttc.username_pw_set("7c1948203b1fd9b62e2acc9d28c05b4b", "6779649ed6266f7c726131ed83cef9d97e6fcbe7")
#nnvnnv--   PBKDF2$sha256$901$nluNtAwIn5CoPbAx$Y96WmTHMJBYGS6FfCA2Y+U79spks48vN
mqttc.on_connect=on_connect
mqttc.on_subscribe=on_subscribe
mqttc.on_publish= on_publish

topic_in= '63c028a9dcfb4504b6b4b50797ad9621/f71cd64f0b3d01cc97c3e5e27bb984e9'
#dev/switch
message='hiii'

mqttc.connect("0.0.0.0", 1883, 60)
mqttc.subscribe(topic_in,1)
rc=0
while(rc==0):
	rc=mqttc.loop()
	mqttc.publish(topic=topic_in,payload=message,qos=1,retain=False)


#name = input("What's your name? ")
