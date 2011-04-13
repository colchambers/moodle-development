var ouinitdone=false;

function ou_init()
{
	if (ouinitdone) return;
	ouinitdone=true;
	//ou_linksline();
	ou_tsinit();
}

function ou_linksline()
{
	if (navigator.appName == "Netscape" && parseFloat(navigator.appVersion) < 5) return;
	ele = document.getElementById("ou-row2");
	if (ele == null) ele = document.getElementById("ou-row3b");
	if (ele == null) return;
	ele = ou_links_createul(ele);
	sb_c = document.cookie + ";";
	sb_p = sb_c.indexOf("SAMSsession");
	sb_h = 0;
	if (sb_p >= 0)
	{
		for (i=sb_p+12 ; ; i++ ) 
		{
			if (sb_c.substr(i, 1) == ';') break;
			sb_h += sb_c.charCodeAt(i);
		}
		sb_p = sb_c.indexOf("%2E", sb_p);
	}
	sb_id = "";
	sb_pi = "";
	if (sb_p >= 0)
	{
		username = "";
		sb_p2 = sb_c.indexOf("HS7BDF=");
		if (sb_p2 >= 0)
		{
			sb_p3 = sb_c.indexOf(";", sb_p2);
			sb_p4 = sb_c.indexOf("\\", sb_p2);
			if (sb_p4 > 0 && sb_p4 < sb_p3)
			{
				if (parseFloat(sb_c.substr(sb_p4+1)) != sb_h) sb_p2 = -1;
				sb_p3 = sb_p4;
			}
			if (sb_p2 >= 0)
			{
				sb_nm = sb_c.substr(sb_p2+7,sb_p3-sb_p2-7);
				sb_nm2 = "";
				for (i=0 ; i < sb_nm.length ; i++)
				{
					j = sb_nm.charCodeAt(i) % 256;
					if (j >= 192 && j <= 223 && i < sb_nm.length-1)
					{
						k = sb_nm.charCodeAt(i+1) % 256;
						sb_nm2 += String.fromCharCode((j-192)*64 + (k-128));
						i++;
					}
					else
						sb_nm2 += String.fromCharCode(j);
				}
				username += sb_nm2 + " ";
			}
		}
		sb_p2 = sb_c.indexOf("%2E", sb_p+3);
		if (sb_p2 - sb_p == 11)
		{
			sb_pi = sb_c.substr(sb_p+3,8);
			ou_links_addnodeinli(ele, document.createTextNode(username + "(" + sb_pi + ")"));
			ou_links_addlink(ele, "ou-studenthome", "https://msds.open.ac.uk/students/", "StudentHome");
		}
		else
		{
			sb_id = "";
			sb_p = sb_c.indexOf("%2E", sb_p2+3);
			if (sb_p - sb_p2 == 11) 
				sb_id = sb_c.substr(sb_p2+3,8);
			else
			{
				sb_p2 = sb_c.indexOf("%2E", sb_p+3);
				if (sb_p2 - sb_p == 11)
					sb_id = sb_c.substr(sb_p+3,8);
				else
				{
					sb_p = sb_c.indexOf("%2E", sb_p2+3);
					if (sb_p - sb_p2 == 11) sb_id = sb_c.substr(sb_p2+3,8);
				}
			}
			ou_links_addnodeinli(ele, document.createTextNode(username + "(" + sb_id + ")"));
			ou_links_addlink(ele, "ou-studenthome", "https://msds.open.ac.uk/students/", "StudentHome");
			ou_links_addlink(ele, "ou-tutorhome", "https://msds.open.ac.uk/tutorhome/", "TutorHome");
			ou_links_addlink(ele, "ou-intranethome", "http://intranet.open.ac.uk/", "IntranetHome");
		}
		ou_links_addlink(ele, "ou-signout", "https://msds.open.ac.uk/signon/samsoff.aspx", "Sign out");
	}
	else
	{
		ou_links_addlink(ele, "ou-signin", "https://msds.open.ac.uk/signon/sams001.aspx?nsh=1&amp;url=" + document.location.href, "Sign in");
	}
}

function ou_links_createul(ele)
{
	var e_ul = document.createElement("ul");
	ele.appendChild(e_ul);
	return e_ul;
}

function ou_links_addlink(e_ul, id, url, text)
{
	var e_a = document.createElement("a");
	e_a.setAttribute("id", id);
	e_a.setAttribute("href", url);
	e_a.appendChild(document.createTextNode(text));
	ou_links_addnodeinli(e_ul, e_a);
}

function ou_links_addnodeinli(e_ul, n_inner)
{
	var e_li = document.createElement("li");
	e_li.appendChild(n_inner);
	e_ul.appendChild(e_li);
}

function ou_tsinit(x)
{
	s = document.cookie + ";";
	i = s.indexOf("P14TS");
	if (i < 0) return;
	j = s.indexOf(";", i);
	if (j < 0) return;
	n = parseFloat(s.substr(i+6, j-i-6));
	if (n < 2 || n > 4) return;
	ou_tschange(n);
}

function ou_tschange(n)
{

	// Grab the area we want to resize
	e = document.getElementById("tsxcontent");
	if (e == null) return;
	
	// Read the cookie
	document.cookie = "P14TS=" + n + "; expires=Sun, 01 Dec 2030 23:59:59 GMT; path=/; domain=open.ac.uk;";
	
	// Set the display to show the cookie info
	if (document.getElementById("ou-smalltext"))
	{
		if (n == 1) document.getElementById("ou-smalltext").style.borderColor='#547FBD'; else document.getElementById("ou-smalltext").style.borderColor='#ccc';
		if (n == 2) document.getElementById("ou-mediumtext").style.borderColor='#547FBD'; else document.getElementById("ou-mediumtext").style.borderColor='#ccc';
		if (n == 3) document.getElementById("ou-largetext").style.borderColor='#547FBD'; else document.getElementById("ou-largetext").style.borderColor='#ccc';
		if (n == 4) document.getElementById("ou-extralargetext").style.borderColor='#547FBD'; else document.getElementById("ou-extralargetext").style.borderColor='#ccc';
	}
	
	// Figure out the font size based on the option chosen
	if (n == 4)
		n = 140;
	else
		n = 90 + n * 10;
		
	// Set anything that can obviously be resized
	e.style.fontSize = n + "%";
		

	// Find all elements with tsx in the id or the classname
	// saves having to code an incrementor for the id, and
	// keeps compatibilty with older sites that already use the incrementor method
	var inc=0;
	var alltags= e.getElementsByTagName("span")
	// change font size of tags that need resizing
	for (i=0; i<alltags.length; i++)
	{
		if (alltags[i].id.indexOf("tsx") != -1 || alltags[i].className.indexOf("tsx") != -1)
			alltags[i].style.fontSize = n + "%";
	}
}


/*
   SiteTracker 5.0.15
   Copyright (C) 2007 Site Intelligence Ltd.
*/

var undefined; // For JS engines that don't support this keyword natively

if (window['siAutoTracer'] == undefined)
{
	window.siAutoTracer = true;  // Set to false if you don't want automatic page tracking
}

if (window['siFireImmediately'] == undefined)
{
   window.siFireImmediately = true; // DO NOT CHANGE. 
   // Not firing immediately is deprecated and will be removed in a future release.
}

var siBaseDirectory   = "/si";
var siTaggingServer   = null; // Send tags to same server as document comes from
var siCookieName      = "SIVISITOR";
var siTracerCookieName= "SITRACER";
var siLinkAttribute   = "si:link";
var siPageIDAttrName  = "si:pageID";
var siCookieQPName    = "simigvis";
var siCookiePath      = "/";
var siCookieTimeout   = 315360000000;
var siDomainList      = new Array(".ac.uk",".net",".co.uk");
var siCentralCookie   = false;
var siCentralReqName  = "req";
var siCentralRefName  = "refer";
var siCentralURL      = "";
var siTrackerUrl      = "/includes/si-tracker.gif";
var siRedirUrl        = siBaseDirectory + "/redirect.html";
// These will be set by functions below - note image set is needed to stop variables going out of scope
var siIsCookieNew	    = "N";
var siCookieValue     = "";
var siExtClickID      = "t"+(new Date()).getTime()+"h"+window.history.length;
var siClickedLinkID   = "";
var siRefClickID      = "";
var siTracerPath      = "";
var siTracerQuery     = "";
var siSendParams      = "";
var siImageSet        = new Array(1);
var siReferrer        = document.referrer;
var siRequest         = document.URL;
var siTagType         = "";
var siSentPageTag     = false;


function SiEncodeString(Input)
{
  if (!Input)
  {
    return "";
  }
  
  var TransChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
  var Output     = "";
  for (var i = 0; i < Input.length; i += 3)
  {
    var NumBytesLeft = Input.length - i;
    var Value        = 0;
    Value  = (Input.charCodeAt(i) << 16) & 0x00ff0000;
    Value |= (NumBytesLeft > 1)? (Input.charCodeAt(i + 1) << 8) & 0x0000ff00 : 0;
    Value |= (NumBytesLeft > 2)? Input.charCodeAt(i + 2) & 0x000000ff : 0;
    Output += TransChars.charAt((Value & 0x00fC0000) >> 18);
    Output += TransChars.charAt((Value & 0x0003f000) >> 12);
    Output += (NumBytesLeft > 1)? TransChars.charAt((Value & 0x00000fc0) >> 6) : '_';
    Output += (NumBytesLeft > 2)? TransChars.charAt((Value & 0x0000003f)) : '_';
  }
  return Output;
}

//---------------------------------------------------------------------------------------------
// Encode all the relevent detals into a string
//---------------------------------------------------------------------------------------------
function SiEncodeDetails(Format)
{
   var Output = "";
   for (var i = 0; i < Format.length; i++)
   {
      var Data;
      switch (Format.charAt(i))
      {
      case 'r':
         Data = siReferrer;
         break;
      case 'p':
         Data = siRequest;      
         break;
      case 'd':
         Data = screen.availWidth+"x"+screen.availHeight+"x"+screen.colorDepth+"."+navigator.javaEnabled();
         if (navigator.plugins) Data += "."+navigator.plugins.length;
         break;
      case 'c':
         Data = siCookieValue;
         break;
      case 'u':
         Data = window.history.length+"."+(Math.random()*1000)+"."+(new Date()).getTime();
         break;
      case 't':
         Data = siExtClickID;
         break;
      case 'f':
         Data = siTracerPath;
         break;
      case 'q':
         Data = siTracerQuery;
         break;
      case 'g':
         Data = SiCollateTagData();
         break;
      case 'w':
         Data = siIsCookieNew;
         break;
      case 'y':
      	Data = siTagType;
      	break;
      }
      Output += SiEncodeString(Data)+"*";
   }  
   return Output;
}

function SiCollateTagData()
{
	var TagData = "";
	
	TagData += "co=" + window.screen.colorDepth;
	TagData += "&sr=" + window.screen.width + 'x' + window.screen.height;
	today = new Date();
	if (null != today)
	{
		TagData += "&lt=" + SiFormatDate(today);
	}
	if (navigator.javaEnabled())
	{
		TagData += "&jv=1";
	}
	else
	{
		TagData += "&jv=0";
	}
	TagData += SiCollatePageRules(); 
	
	if (document.body)
	{
		var ThisPageID = document.body.getAttribute(siPageIDAttrName);
		if (ThisPageID)
		{
			TagData += "&req=" + ThisPageID;
		}
	}
		
	if (siClickedLinkID && siClickedLinkID.length > 0)
	{
		TagData += "&rl=" + siClickedLinkID;
	}
	
	if (siRefClickID.length > 0)
	{
		TagData += "&rcid=" + siRefClickID;
	}
	
	return TagData;
}	

function SiCollatePageRules()
{
	var PageData = "";

	if (window.siIsFrameset)
	{
		PageData += "&page:fset";
	}
	if (window.siIsMenu)
	{
		PageData += "&page:menu";
	}
	if (window.siIsExtraFrame)
	{
		PageData += "&page:x-frame";
	}
	if (window.siIsRedirection)
	{
		PageData += "&page:redir";
	}
	if (window.siIsPopup)
	{
		PageData += "&page:popup";
	}
	
	return PageData;
}

function SiIsMenu()
{
	window.siIsMenu = true;
}

function SiIsFrameset()
{
	window.siIsFrameset = true;
}

function SiIsExtraFrame()
{
	window.siIsExtraFrame = true;
}

function SiIsRedirection()
{
	window.siIsRedirection = true;
}

function SiIsPopup()
{
	window.siIsPopup = true;
}

function SiSetPageID(id)
{
	document.body.setAttribute(siPageIDAttrName,id);
}

function SiFormatDate(date)
{
	var output = "";
	output += date.getFullYear()+"";
	output += "-";
	output += leadingZero(date.getMonth()+1);
	output += "-";
	output += leadingZero(date.getDate());
	output += "T";
	output += leadingZero(date.getHours());
	output += ":";
	output += leadingZero(date.getMinutes());
	output += ":";
	output += leadingZero(date.getSeconds());
	return output;
}

function leadingZero(n)
{
	return (n>9?"":"0") + n;
}

function SiGetDomain()
{
  var DomainValue = null;
  var firstDot;
  var secondDot;
  var lastDot;
  var useHostname=document.location.hostname;
  if (useHostname != null)
  {
     var arIndex;
     for (arIndex = 0; (arIndex < siDomainList.length) && (DomainValue == null); arIndex++)
     {
        var tldIndex = useHostname.lastIndexOf(siDomainList[arIndex]);
        if (tldIndex > 0)
        {
           var nextDot = useHostname.lastIndexOf('.',tldIndex-1);
           if (nextDot >= 0)
           {
              DomainValue = useHostname.substring(nextDot);
           }
           else
           {
              DomainValue = "." + useHostname;
           }
        }
     }
  }
  return DomainValue;
}

function SiTrackLink(idVar)
{
   siTagType="trace";
   
	if (/string/.test(typeof(idVar)))
	{
		siClickedLinkID = idVar;
	}
	else
	{
		// We have an anchor tag or equivalent
		siClickedLinkID = idVar.getAttribute(siLinkAttribute);
	}
	
	SiInternalTrackLink();
	return true;
}

function SiInternalTrackLink()
{
	siRefClickID = siExtClickID;
	siTracerPath = siBaseDirectory + "/link";
	siTracerQuery = "";
	SiDeferTracer("fctgy","fdtgy");
	
	siClickedLinkID = "";
	siRefClickID = "";
	siTracerPath = "";
}

function SiTrackEvent(eventName)
{
   siClickedLinkID = eventName;
   siTagType = "trace";
   SiInternalTrackLink();
   SiSendDeferredTracers();
}

function SiInternalTrackLinkViaRedirection(anchorTag)
{
	siClickedLinkID = anchorTag.getAttribute(siLinkAttribute);
	SiInternalTrackLink();
	var destination = anchorTag.href;
	anchorTag.href = siRedirUrl + "?redir=" + escape(destination);
}

function SiTrackExternalLink(anchorTag)
{
   siTagType="trace";
	SiInternalTrackLinkViaRedirection(anchorTag);
}

function SiTrackLinkToUntagged(anchorTag)
{
   siTagType="page";
	SiInternalTrackLinkViaRedirection(anchorTag);
}

function SiTrackData(query)
{
   siTracerPath = "http://" + document.location.hostname + siBaseDirectory + "/data";
   siTracerQuery = query;
   siTagType = "extra";
   SiSendTracer(false,"fqcrtgy","fqdrtgy");
}

function SiAddTrackParam( name, value )
{
   if (siSendParams != "")
    	siSendParams += "&";
   siSendParams += escape(name) + "=" + escape(value);
   if (siSendParams.length >= 512)
   	SiSendTrackParams();
}

function SiSendTrackParams()
{
	if (siSendParams != "")
	{
		SiTrackData(siSendParams);	
	   siSendParams = "";
	}
}

function SiSetCookie(Name,Value,Timeout)
{
  	var Expiry=new Date;
  	Expiry.setTime(Expiry.getTime()+Timeout);
 	var Domain=SiGetDomain();
 	var OldValue=SiGetCookie(Name);
  	var CookieDetails=Name+"="+Value+((siCookiePath) ? "; path=" + siCookiePath : "")+((Domain) ? "; domain="+Domain : "");
  	document.cookie=CookieDetails + "; expires=\""+Expiry.toGMTString()+"\" ";
  	if (SiGetCookie(siCookieName) == OldValue)
  	{
  	   // Failed to set persistent cookie so try session cookie
		document.cookie=CookieDetails;
	}
}

function SiGetCookie(Name)
{
   return SiExtractPart(Name,document.cookie,";");
}

function SiExtractPart(Name,DataSource,DataEndChar) 
{
  var Prefix = Name+"=";
  var Value  = null;
  var Begin  = DataSource.indexOf(Prefix);
  if ((Begin != -1) && (Name.length > 0))
  {
    var End = DataSource.indexOf(DataEndChar,Begin);
    if (End == -1) End = DataSource.length;
    Value = DataSource.substring(Begin+Prefix.length,End);
  } 
  return Value;
}

// Delete by setting the expiry to a time in the past.  The cookie will be
// deleted as soon as it is written.
function SiDeleteCookie(Name)
{
	var ExpiryDate = new Date();  // current date & time
	ExpiryDate.setTime(ExpiryDate.getTime() - 1);
	var CookieDetails = Name + "=null; expires=" + ExpiryDate.toGMTString();
	document.cookie = CookieDetails;
}

function SiBuildCookie()
{
   var CookieValue=SiExtractPart(siCookieQPName,document.URL,"&");
   if (CookieValue != null) 
   {
      SiSetCookie(siCookieName,CookieValue,siCookieTimeout);

      if (siCentralCookie)
      {
         // Extract original referrer
         var extractedURL = SiExtractPart(siCentralRefName,document.URL,"&");
         if (extractedURL != null)
         {
            siReferrer = unescape(extractedURL);
         }

         // Extract original request
         extractedURL = SiExtractPart(siCentralReqName,document.URL,"&");
         if (extractedURL != null)
         {
            siRequest = unescape(extractedURL);
         }
      }
   }
   else
   {
      CookieValue=SiGetCookie(siCookieName);
      if (CookieValue == null)
      {
         CookieValue=SiEncodeDetails("u");
         siIsCookieNew = 'Y';
         SiSetCookie(siCookieName,CookieValue,siCookieTimeout);

         if (siCentralCookie)
         {
            // Check cookies can be set
            CookieValue = SiGetCookie(siCookieName);
            if (CookieValue != null)
            {
               var centralURL = siCentralURL;
               if (siCentralURL.indexOf("?") == -1)
               {
                  centralURL += "?";
               }
               else
               {
                  centralURL += "&";
               }
               centralURL += siCentralReqName+"="+escape(document.URL)+"&"+siCentralRefName+"="+escape(document.referrer);

               // Stop any possibility of tag firing
               siAutoTracer = false;

               // Redirect to central cookie server
               document.location = centralURL;
            }
         }
      }
   }
   CookieValue = SiGetCookie(siCookieName);
   return CookieValue;
}

function SiMigrateCookie(link)
{
   var CookieValue=SiGetCookie(siCookieName);
   if (CookieValue != null) link.href=link.href+((link.href.indexOf('?') > 0) ? "&" : "?")+siCookieQPName+"="+CookieValue;
   return true;
}

function SiMigrateCookieForm(form)
{
   var CookieValue=SiGetCookie(siCookieName);
   if (CookieValue != null) form.action=form.action+((form.action.indexOf('?') > 0) ? "&" : "?")+siCookieQPName+"="+CookieValue;
   return true;
}

function SiProcessTracer(cookieForm,noCookieForm,dispatcher)
{
	var tracer;
	if (siCookieValue == null)
	{
		tracer = siTaggingServer + siTrackerUrl + "?f=" + noCookieForm + "&d=" + SiEncodeDetails(noCookieForm);
	}
	else
	{
		tracer = siTaggingServer + siTrackerUrl + "?f=" + cookieForm + "&d=" + SiEncodeDetails(cookieForm);
	}
	
	siTagType="";
	dispatcher(tracer);
}

function SiSendTracer(isPage,cookieForm,noCookieForm)
{
	var sendNow = function(tracer) {
	   // If we've got siFireImmediately off but autoTracer on we need to
	   // ensure the page tag fires before we send any non-page tracer
	   if (!isPage && window.siAutoTracer && !siSentPageTag)
	   {	   	
	   	SiTrackPage();
	   }
		var Tracker = new Image();
		Tracker.src = tracer;
		siImageSet[siImageSet.length] = Tracker;
	}
   
   SiProcessTracer(cookieForm,noCookieForm,sendNow);
}

function SiDeferTracer(cookieForm,noCookieForm)
{
	var defer = function(tracer) {
	   SiSetCookie(siTracerCookieName,tracer,60000);
	}
	
	SiTagType="tracer";
	SiProcessTracer(cookieForm,noCookieForm,defer);
}

function SiTrackFormData(form,list)
{
	return SiTrackForm(null,form,list);
}

function SiTrackForm(filePath,form,list)
{
   siTracerPath = filePath == null ? "/si/form" : filePath;
   siTracerQuery = "";
   if (form.elements && (form.elements.length > 0))
   {
      var doamp=false;
      for (var i=0; i<form.elements.length; i++)
      {
         var el=form.elements[i];
         if (el.name)
         {
            var capture=(list == null);
            if (list != null)
            {
               for (var j=0; !capture && (j<list.length); j++)
               {
                  if (el.name == list[j]) capture = true;      
               }
            }
            if (capture && (el.type == "radio")) capture = el.checked;
            if (capture) 
            {
               if (doamp) siTracerQuery += "&";
               siTracerQuery += escape(el.name)+"="+((el.type=="checkbox") ? ((el.checked) ? "true" : "false") : escape(el.value));
               doamp=true;
            }
         }
      }
   } 
   siTagType = "trace";
   SiDeferTracer("fqcrty","fqdrty");
   return true;
}

function SiTrackTracer(filePath,queryString)
{
   // If a base relative path prepend it with document protocol and hostname
   if (filePath.substring(0,1) == '/')
   {
      filePath = document.location.protocol + "//" + document.location.hostname + filePath;
   }
   siTracerPath = filePath;
   siTracerQuery = queryString;
   siTagType="trace";
   SiSendTracer(false,"fqcrtgy","fqdrtgy");
}

function SiTrackPage(pageID)
{
   if (!siSentPageTag)
   {
	   // If a page ID is supplied use it (ensuring it starts with /) as the path
	   // but keep any existing query string
	   if (pageID != undefined)
	   {
	      if(!pageID.substring(0,1) == '/')
	          pageID = '/' + pageID;
	      siRequest = pageID + window.location.search;
	   }
	
		siTagType = "page";
	   siCookieValue = SiBuildCookie();	   
	   SiSendDeferredTracers();
	   SiSendTracer(true,"pcrtgy","pdrtgy");
	   siSentPageTag = true;
   }
}

function SiInitPage()
{
   // Check if tagging server is specified
	if (siTaggingServer == null)
	{
		siTaggingServer = document.location.protocol + "//" + document.location.hostname + ":" + document.location.port;
	}
	else if (siTaggingServer.substring(0,4) != "http")
	{
		// Assume tagging server specifies hostname but pick up protocol+port from document location
		siTaggingServer = document.location.protocol + "//" + siTaggingServer + ":" + document.location.port;
	}
}

function SiSendDeferredTracers()
{
	var tracer = SiGetCookie(siTracerCookieName);
	if (tracer)
	{
		var Tracker = new Image();
   	Tracker.src = tracer;
      siImageSet[siImageSet.length] = Tracker;
      
      SiDeleteCookie(siTracerCookieName);
	}
}

// This function stops us overwriting any other onload events
function SiWindowOnload(f)
{
   var prev=window.onload;
   window.onload=function(){ if(prev)prev(); f(); }
}

SiInitPage();
  
// We prefer to send the tracer once the page has loaded - this lets us process any page type tags
// present.  However, the onload event may be overwritten by client code - in which case we need
// to fire now
if (window.siAutoTracer) 
{
	if (siFireImmediately)
	{
		SiTrackPage();
	}
	else
	{
		SiWindowOnload(SiTrackPage);
	}
}

