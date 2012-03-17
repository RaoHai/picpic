package
{  
     import flash.display.Sprite;
     import flash.media.Microphone;
     import flash.events.StatusEvent;
     import flash.events.ActivityEvent;
     public class luyin extends Sprite
     { 
           public function luyin()
           {
                   var mic:Microphone=Microphone.getMicrophone();
                   mic.setUerEchoSuppression(true);
                   mic.setLoopBack(true);
                   if(mic!=null)
                   {
                       mic.addEventListener(ActivityEvent.ACTIVITY,activityHandler);
                       mic.addEventListener(StatusEvent.STATUS,this.onMicStatus);
                    }
             }
             private function activityHandler(event:ActivityEvent):void
            {
                trace("activityHandler:"+event);
            }
					function onMicStatus(event:StatusEvent):void
					{
					 if(event.code=="Microphone.Unmuted")
						{
						   trace("麦克风允许通信的。");
						}
					  else if(event.code=="Microphone.Muted")
							{
							  trace("麦克风禁止通信。");
							}  
					}
         }
}