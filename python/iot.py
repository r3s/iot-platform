import paho.mqtt.client as mqttP


def on_connect(mqttc,userdata,flag,rc):
    print ("connected rc:"+str(rc))
    print ("userdata :"+ str(userdata))


def on_subscribe(client, userdata, mid, gqos):
    print('Subscribed: ' + str(mid))
#
def on_publish(client, userdata, mid):
    print('publish ' + str(mid))
    print('publish ' + str(userdata))
def on_message(client,userdata,message):
	print("Received message '" + str(message.payload) + "' on topic '" + message.topic + "' with QoS " + str(message.qos))






mqttc=mqttP.Client(userdata="iot server", protocol=mqttP.MQTTv311)
mqttc.username_pw_set("su1", "1234")
#nnvnnv--   PBKDF2$sha256$901$RO8UGposqF0hQCmM$PMEnuu5tKEQ3TTCpT4i00syUeF03RHn5
mqttc.on_connect=on_connect
mqttc.on_subscribe=on_subscribe
mqttc.on_publish= on_publish
mqttc.on_message=on_message

topic_in= '63c028a9dcfb4504b6b4b50797ad9621/#'
topic_out= '63c028a9dcfb4504b6b4b50797ad9621/f71cd64f0b3d01cc97c3e5e27bb984e9'
#dev/switch
message='hiii'

mqttc.connect("0.0.0.0", 1883, 60)
mqttc.subscribe(topic_in,1)
rc=0
while(rc==0):
    mqttc.publish(topic=topic_out,payload=message,qos=0,retain=False)
    rc=mqttc.loop_forever()

#mqttc.publish(topic=topic_in,payload=message,qos=0,retain=False)
#name = input("What's your name? ")
