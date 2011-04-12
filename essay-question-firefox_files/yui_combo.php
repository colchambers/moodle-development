/*
Copyright (c) 2010, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.com/yui/license.html
version: 2.8.1
*/
if(typeof YAHOO=="undefined"||!YAHOO){var YAHOO={};}YAHOO.namespace=function(){var A=arguments,E=null,C,B,D;for(C=0;C<A.length;C=C+1){D=(""+A[C]).split(".");E=YAHOO;for(B=(D[0]=="YAHOO")?1:0;B<D.length;B=B+1){E[D[B]]=E[D[B]]||{};E=E[D[B]];}}return E;};YAHOO.log=function(D,A,C){var B=YAHOO.widget.Logger;if(B&&B.log){return B.log(D,A,C);}else{return false;}};YAHOO.register=function(A,E,D){var I=YAHOO.env.modules,B,H,G,F,C;if(!I[A]){I[A]={versions:[],builds:[]};}B=I[A];H=D.version;G=D.build;F=YAHOO.env.listeners;B.name=A;B.version=H;B.build=G;B.versions.push(H);B.builds.push(G);B.mainClass=E;for(C=0;C<F.length;C=C+1){F[C](B);}if(E){E.VERSION=H;E.BUILD=G;}else{YAHOO.log("mainClass is undefined for module "+A,"warn");}};YAHOO.env=YAHOO.env||{modules:[],listeners:[]};YAHOO.env.getVersion=function(A){return YAHOO.env.modules[A]||null;};YAHOO.env.ua=function(){var D=function(H){var I=0;return parseFloat(H.replace(/\./g,function(){return(I++==1)?"":".";}));},G=navigator,F={ie:0,opera:0,gecko:0,webkit:0,mobile:null,air:0,caja:G.cajaVersion,secure:false,os:null},C=navigator&&navigator.userAgent,E=window&&window.location,B=E&&E.href,A;F.secure=B&&(B.toLowerCase().indexOf("https")===0);if(C){if((/windows|win32/i).test(C)){F.os="windows";}else{if((/macintosh/i).test(C)){F.os="macintosh";}}if((/KHTML/).test(C)){F.webkit=1;}A=C.match(/AppleWebKit\/([^\s]*)/);if(A&&A[1]){F.webkit=D(A[1]);if(/ Mobile\//.test(C)){F.mobile="Apple";}else{A=C.match(/NokiaN[^\/]*/);if(A){F.mobile=A[0];}}A=C.match(/AdobeAIR\/([^\s]*)/);if(A){F.air=A[0];}}if(!F.webkit){A=C.match(/Opera[\s\/]([^\s]*)/);if(A&&A[1]){F.opera=D(A[1]);A=C.match(/Opera Mini[^;]*/);if(A){F.mobile=A[0];}}else{A=C.match(/MSIE\s([^;]*)/);if(A&&A[1]){F.ie=D(A[1]);}else{A=C.match(/Gecko\/([^\s]*)/);if(A){F.gecko=1;A=C.match(/rv:([^\s\)]*)/);if(A&&A[1]){F.gecko=D(A[1]);}}}}}}return F;}();(function(){YAHOO.namespace("util","widget","example");if("undefined"!==typeof YAHOO_config){var B=YAHOO_config.listener,A=YAHOO.env.listeners,D=true,C;if(B){for(C=0;C<A.length;C++){if(A[C]==B){D=false;break;}}if(D){A.push(B);}}}})();YAHOO.lang=YAHOO.lang||{};(function(){var B=YAHOO.lang,A=Object.prototype,H="[object Array]",C="[object Function]",G="[object Object]",E=[],F=["toString","valueOf"],D={isArray:function(I){return A.toString.apply(I)===H;},isBoolean:function(I){return typeof I==="boolean";},isFunction:function(I){return(typeof I==="function")||A.toString.apply(I)===C;},isNull:function(I){return I===null;},isNumber:function(I){return typeof I==="number"&&isFinite(I);},isObject:function(I){return(I&&(typeof I==="object"||B.isFunction(I)))||false;},isString:function(I){return typeof I==="string";},isUndefined:function(I){return typeof I==="undefined";},_IEEnumFix:(YAHOO.env.ua.ie)?function(K,J){var I,M,L;for(I=0;I<F.length;I=I+1){M=F[I];L=J[M];if(B.isFunction(L)&&L!=A[M]){K[M]=L;}}}:function(){},extend:function(L,M,K){if(!M||!L){throw new Error("extend failed, please check that "+"all dependencies are included.");}var J=function(){},I;J.prototype=M.prototype;L.prototype=new J();L.prototype.constructor=L;L.superclass=M.prototype;if(M.prototype.constructor==A.constructor){M.prototype.constructor=M;}if(K){for(I in K){if(B.hasOwnProperty(K,I)){L.prototype[I]=K[I];}}B._IEEnumFix(L.prototype,K);}},augmentObject:function(M,L){if(!L||!M){throw new Error("Absorb failed, verify dependencies.");}var I=arguments,K,N,J=I[2];if(J&&J!==true){for(K=2;K<I.length;K=K+1){M[I[K]]=L[I[K]];}}else{for(N in L){if(J||!(N in M)){M[N]=L[N];}}B._IEEnumFix(M,L);}},augmentProto:function(L,K){if(!K||!L){throw new Error("Augment failed, verify dependencies.");}var I=[L.prototype,K.prototype],J;for(J=2;J<arguments.length;J=J+1){I.push(arguments[J]);}B.augmentObject.apply(this,I);},dump:function(I,N){var K,M,P=[],Q="{...}",J="f(){...}",O=", ",L=" => ";if(!B.isObject(I)){return I+"";}else{if(I instanceof Date||("nodeType" in I&&"tagName" in I)){return I;}else{if(B.isFunction(I)){return J;}}}N=(B.isNumber(N))?N:3;if(B.isArray(I)){P.push("[");for(K=0,M=I.length;K<M;K=K+1){if(B.isObject(I[K])){P.push((N>0)?B.dump(I[K],N-1):Q);}else{P.push(I[K]);}P.push(O);}if(P.length>1){P.pop();}P.push("]");}else{P.push("{");for(K in I){if(B.hasOwnProperty(I,K)){P.push(K+L);if(B.isObject(I[K])){P.push((N>0)?B.dump(I[K],N-1):Q);}else{P.push(I[K]);}P.push(O);}}if(P.length>1){P.pop();}P.push("}");}return P.join("");},substitute:function(Y,J,R){var N,M,L,U,V,X,T=[],K,O="dump",S=" ",I="{",W="}",Q,P;for(;;){N=Y.lastIndexOf(I);if(N<0){break;}M=Y.indexOf(W,N);if(N+1>=M){break;}K=Y.substring(N+1,M);U=K;X=null;L=U.indexOf(S);if(L>-1){X=U.substring(L+1);U=U.substring(0,L);}V=J[U];if(R){V=R(U,V,X);}if(B.isObject(V)){if(B.isArray(V)){V=B.dump(V,parseInt(X,10));}else{X=X||"";Q=X.indexOf(O);if(Q>-1){X=X.substring(4);}P=V.toString();if(P===G||Q>-1){V=B.dump(V,parseInt(X,10));}else{V=P;}}}else{if(!B.isString(V)&&!B.isNumber(V)){V="~-"+T.length+"-~";T[T.length]=K;}}Y=Y.substring(0,N)+V+Y.substring(M+1);}for(N=T.length-1;N>=0;N=N-1){Y=Y.replace(new RegExp("~-"+N+"-~"),"{"+T[N]+"}","g");}return Y;},trim:function(I){try{return I.replace(/^\s+|\s+$/g,"");}catch(J){return I;}},merge:function(){var L={},J=arguments,I=J.length,K;for(K=0;K<I;K=K+1){B.augmentObject(L,J[K],true);}return L;},later:function(P,J,Q,L,M){P=P||0;J=J||{};var K=Q,O=L,N,I;if(B.isString(Q)){K=J[Q];}if(!K){throw new TypeError("method undefined");}if(O&&!B.isArray(O)){O=[L];}N=function(){K.apply(J,O||E);};I=(M)?setInterval(N,P):setTimeout(N,P);return{interval:M,cancel:function(){if(this.interval){clearInterval(I);}else{clearTimeout(I);}}};},isValue:function(I){return(B.isObject(I)||B.isString(I)||B.isNumber(I)||B.isBoolean(I));}};B.hasOwnProperty=(A.hasOwnProperty)?function(I,J){return I&&I.hasOwnProperty(J);}:function(I,J){return !B.isUndefined(I[J])&&I.constructor.prototype[J]!==I[J];};D.augmentObject(B,D,true);YAHOO.util.Lang=B;B.augment=B.augmentProto;YAHOO.augment=B.augmentProto;YAHOO.extend=B.extend;})();YAHOO.register("yahoo",YAHOO,{version:"2.8.1",build:"19"});
(function(){YAHOO.env._id_counter=YAHOO.env._id_counter||0;var E=YAHOO.util,L=YAHOO.lang,m=YAHOO.env.ua,A=YAHOO.lang.trim,d={},h={},N=/^t(?:able|d|h)$/i,X=/color$/i,K=window.document,W=K.documentElement,e="ownerDocument",n="defaultView",v="documentElement",t="compatMode",b="offsetLeft",P="offsetTop",u="offsetParent",Z="parentNode",l="nodeType",C="tagName",O="scrollLeft",i="scrollTop",Q="getBoundingClientRect",w="getComputedStyle",a="currentStyle",M="CSS1Compat",c="BackCompat",g="class",F="className",J="",B=" ",s="(?:^|\\s)",k="(?= |$)",U="g",p="position",f="fixed",V="relative",j="left",o="top",r="medium",q="borderLeftWidth",R="borderTopWidth",D=m.opera,I=m.webkit,H=m.gecko,T=m.ie;E.Dom={CUSTOM_ATTRIBUTES:(!W.hasAttribute)?{"for":"htmlFor","class":F}:{"htmlFor":"for","className":g},DOT_ATTRIBUTES:{},get:function(z){var AB,x,AA,y,Y,G;if(z){if(z[l]||z.item){return z;}if(typeof z==="string"){AB=z;z=K.getElementById(z);G=(z)?z.attributes:null;if(z&&G&&G.id&&G.id.value===AB){return z;}else{if(z&&K.all){z=null;x=K.all[AB];for(y=0,Y=x.length;y<Y;++y){if(x[y].id===AB){return x[y];}}}}return z;}if(YAHOO.util.Element&&z instanceof YAHOO.util.Element){z=z.get("element");}if("length" in z){AA=[];for(y=0,Y=z.length;y<Y;++y){AA[AA.length]=E.Dom.get(z[y]);}return AA;}return z;}return null;},getComputedStyle:function(G,Y){if(window[w]){return G[e][n][w](G,null)[Y];}else{if(G[a]){return E.Dom.IE_ComputedStyle.get(G,Y);}}},getStyle:function(G,Y){return E.Dom.batch(G,E.Dom._getStyle,Y);},_getStyle:function(){if(window[w]){return function(G,y){y=(y==="float")?y="cssFloat":E.Dom._toCamel(y);var x=G.style[y],Y;if(!x){Y=G[e][n][w](G,null);if(Y){x=Y[y];}}return x;};}else{if(W[a]){return function(G,y){var x;switch(y){case"opacity":x=100;try{x=G.filters["DXImageTransform.Microsoft.Alpha"].opacity;}catch(z){try{x=G.filters("alpha").opacity;}catch(Y){}}return x/100;case"float":y="styleFloat";default:y=E.Dom._toCamel(y);x=G[a]?G[a][y]:null;return(G.style[y]||x);}};}}}(),setStyle:function(G,Y,x){E.Dom.batch(G,E.Dom._setStyle,{prop:Y,val:x});},_setStyle:function(){if(T){return function(Y,G){var x=E.Dom._toCamel(G.prop),y=G.val;if(Y){switch(x){case"opacity":if(L.isString(Y.style.filter)){Y.style.filter="alpha(opacity="+y*100+")";if(!Y[a]||!Y[a].hasLayout){Y.style.zoom=1;}}break;case"float":x="styleFloat";default:Y.style[x]=y;}}else{}};}else{return function(Y,G){var x=E.Dom._toCamel(G.prop),y=G.val;if(Y){if(x=="float"){x="cssFloat";}Y.style[x]=y;}else{}};}}(),getXY:function(G){return E.Dom.batch(G,E.Dom._getXY);},_canPosition:function(G){return(E.Dom._getStyle(G,"display")!=="none"&&E.Dom._inDoc(G));},_getXY:function(){if(K[v][Q]){return function(y){var z,Y,AA,AF,AE,AD,AC,G,x,AB=Math.floor,AG=false;if(E.Dom._canPosition(y)){AA=y[Q]();AF=y[e];z=E.Dom.getDocumentScrollLeft(AF);Y=E.Dom.getDocumentScrollTop(AF);AG=[AB(AA[j]),AB(AA[o])];if(T&&m.ie<8){AE=2;AD=2;AC=AF[t];if(m.ie===6){if(AC!==c){AE=0;AD=0;}}if((AC===c)){G=S(AF[v],q);x=S(AF[v],R);if(G!==r){AE=parseInt(G,10);}if(x!==r){AD=parseInt(x,10);}}AG[0]-=AE;AG[1]-=AD;}if((Y||z)){AG[0]+=z;AG[1]+=Y;}AG[0]=AB(AG[0]);AG[1]=AB(AG[1]);}else{}return AG;};}else{return function(y){var x,Y,AA,AB,AC,z=false,G=y;if(E.Dom._canPosition(y)){z=[y[b],y[P]];x=E.Dom.getDocumentScrollLeft(y[e]);Y=E.Dom.getDocumentScrollTop(y[e]);AC=((H||m.webkit>519)?true:false);while((G=G[u])){z[0]+=G[b];z[1]+=G[P];if(AC){z=E.Dom._calcBorders(G,z);}}if(E.Dom._getStyle(y,p)!==f){G=y;while((G=G[Z])&&G[C]){AA=G[i];AB=G[O];if(H&&(E.Dom._getStyle(G,"overflow")!=="visible")){z=E.Dom._calcBorders(G,z);}if(AA||AB){z[0]-=AB;z[1]-=AA;}}z[0]+=x;z[1]+=Y;}else{if(D){z[0]-=x;z[1]-=Y;}else{if(I||H){z[0]+=x;z[1]+=Y;}}}z[0]=Math.floor(z[0]);z[1]=Math.floor(z[1]);}else{}return z;};}}(),getX:function(G){var Y=function(x){return E.Dom.getXY(x)[0];};return E.Dom.batch(G,Y,E.Dom,true);},getY:function(G){var Y=function(x){return E.Dom.getXY(x)[1];};return E.Dom.batch(G,Y,E.Dom,true);},setXY:function(G,x,Y){E.Dom.batch(G,E.Dom._setXY,{pos:x,noRetry:Y});},_setXY:function(G,z){var AA=E.Dom._getStyle(G,p),y=E.Dom.setStyle,AD=z.pos,Y=z.noRetry,AB=[parseInt(E.Dom.getComputedStyle(G,j),10),parseInt(E.Dom.getComputedStyle(G,o),10)],AC,x;if(AA=="static"){AA=V;y(G,p,AA);}AC=E.Dom._getXY(G);if(!AD||AC===false){return false;}if(isNaN(AB[0])){AB[0]=(AA==V)?0:G[b];}if(isNaN(AB[1])){AB[1]=(AA==V)?0:G[P];}if(AD[0]!==null){y(G,j,AD[0]-AC[0]+AB[0]+"px");}if(AD[1]!==null){y(G,o,AD[1]-AC[1]+AB[1]+"px");}if(!Y){x=E.Dom._getXY(G);if((AD[0]!==null&&x[0]!=AD[0])||(AD[1]!==null&&x[1]!=AD[1])){E.Dom._setXY(G,{pos:AD,noRetry:true});}}},setX:function(Y,G){E.Dom.setXY(Y,[G,null]);},setY:function(G,Y){E.Dom.setXY(G,[null,Y]);},getRegion:function(G){var Y=function(x){var y=false;if(E.Dom._canPosition(x)){y=E.Region.getRegion(x);}else{}return y;};return E.Dom.batch(G,Y,E.Dom,true);},getClientWidth:function(){return E.Dom.getViewportWidth();},getClientHeight:function(){return E.Dom.getViewportHeight();},getElementsByClassName:function(AB,AF,AC,AE,x,AD){AF=AF||"*";AC=(AC)?E.Dom.get(AC):null||K;if(!AC){return[];}var Y=[],G=AC.getElementsByTagName(AF),z=E.Dom.hasClass;for(var y=0,AA=G.length;y<AA;++y){if(z(G[y],AB)){Y[Y.length]=G[y];}}if(AE){E.Dom.batch(Y,AE,x,AD);}return Y;},hasClass:function(Y,G){return E.Dom.batch(Y,E.Dom._hasClass,G);},_hasClass:function(x,Y){var G=false,y;if(x&&Y){y=E.Dom._getAttribute(x,F)||J;if(Y.exec){G=Y.test(y);}else{G=Y&&(B+y+B).indexOf(B+Y+B)>-1;}}else{}return G;},addClass:function(Y,G){return E.Dom.batch(Y,E.Dom._addClass,G);},_addClass:function(x,Y){var G=false,y;if(x&&Y){y=E.Dom._getAttribute(x,F)||J;if(!E.Dom._hasClass(x,Y)){E.Dom.setAttribute(x,F,A(y+B+Y));G=true;}}else{}return G;},removeClass:function(Y,G){return E.Dom.batch(Y,E.Dom._removeClass,G);},_removeClass:function(y,x){var Y=false,AA,z,G;if(y&&x){AA=E.Dom._getAttribute(y,F)||J;E.Dom.setAttribute(y,F,AA.replace(E.Dom._getClassRegex(x),J));z=E.Dom._getAttribute(y,F);if(AA!==z){E.Dom.setAttribute(y,F,A(z));Y=true;if(E.Dom._getAttribute(y,F)===""){G=(y.hasAttribute&&y.hasAttribute(g))?g:F;
y.removeAttribute(G);}}}else{}return Y;},replaceClass:function(x,Y,G){return E.Dom.batch(x,E.Dom._replaceClass,{from:Y,to:G});},_replaceClass:function(y,x){var Y,AB,AA,G=false,z;if(y&&x){AB=x.from;AA=x.to;if(!AA){G=false;}else{if(!AB){G=E.Dom._addClass(y,x.to);}else{if(AB!==AA){z=E.Dom._getAttribute(y,F)||J;Y=(B+z.replace(E.Dom._getClassRegex(AB),B+AA)).split(E.Dom._getClassRegex(AA));Y.splice(1,0,B+AA);E.Dom.setAttribute(y,F,A(Y.join(J)));G=true;}}}}else{}return G;},generateId:function(G,x){x=x||"yui-gen";var Y=function(y){if(y&&y.id){return y.id;}var z=x+YAHOO.env._id_counter++;if(y){if(y[e]&&y[e].getElementById(z)){return E.Dom.generateId(y,z+x);}y.id=z;}return z;};return E.Dom.batch(G,Y,E.Dom,true)||Y.apply(E.Dom,arguments);},isAncestor:function(Y,x){Y=E.Dom.get(Y);x=E.Dom.get(x);var G=false;if((Y&&x)&&(Y[l]&&x[l])){if(Y.contains&&Y!==x){G=Y.contains(x);}else{if(Y.compareDocumentPosition){G=!!(Y.compareDocumentPosition(x)&16);}}}else{}return G;},inDocument:function(G,Y){return E.Dom._inDoc(E.Dom.get(G),Y);},_inDoc:function(Y,x){var G=false;if(Y&&Y[C]){x=x||Y[e];G=E.Dom.isAncestor(x[v],Y);}else{}return G;},getElementsBy:function(Y,AF,AB,AD,y,AC,AE){AF=AF||"*";AB=(AB)?E.Dom.get(AB):null||K;if(!AB){return[];}var x=[],G=AB.getElementsByTagName(AF);for(var z=0,AA=G.length;z<AA;++z){if(Y(G[z])){if(AE){x=G[z];break;}else{x[x.length]=G[z];}}}if(AD){E.Dom.batch(x,AD,y,AC);}return x;},getElementBy:function(x,G,Y){return E.Dom.getElementsBy(x,G,Y,null,null,null,true);},batch:function(x,AB,AA,z){var y=[],Y=(z)?AA:window;x=(x&&(x[C]||x.item))?x:E.Dom.get(x);if(x&&AB){if(x[C]||x.length===undefined){return AB.call(Y,x,AA);}for(var G=0;G<x.length;++G){y[y.length]=AB.call(Y,x[G],AA);}}else{return false;}return y;},getDocumentHeight:function(){var Y=(K[t]!=M||I)?K.body.scrollHeight:W.scrollHeight,G=Math.max(Y,E.Dom.getViewportHeight());return G;},getDocumentWidth:function(){var Y=(K[t]!=M||I)?K.body.scrollWidth:W.scrollWidth,G=Math.max(Y,E.Dom.getViewportWidth());return G;},getViewportHeight:function(){var G=self.innerHeight,Y=K[t];if((Y||T)&&!D){G=(Y==M)?W.clientHeight:K.body.clientHeight;}return G;},getViewportWidth:function(){var G=self.innerWidth,Y=K[t];if(Y||T){G=(Y==M)?W.clientWidth:K.body.clientWidth;}return G;},getAncestorBy:function(G,Y){while((G=G[Z])){if(E.Dom._testElement(G,Y)){return G;}}return null;},getAncestorByClassName:function(Y,G){Y=E.Dom.get(Y);if(!Y){return null;}var x=function(y){return E.Dom.hasClass(y,G);};return E.Dom.getAncestorBy(Y,x);},getAncestorByTagName:function(Y,G){Y=E.Dom.get(Y);if(!Y){return null;}var x=function(y){return y[C]&&y[C].toUpperCase()==G.toUpperCase();};return E.Dom.getAncestorBy(Y,x);},getPreviousSiblingBy:function(G,Y){while(G){G=G.previousSibling;if(E.Dom._testElement(G,Y)){return G;}}return null;},getPreviousSibling:function(G){G=E.Dom.get(G);if(!G){return null;}return E.Dom.getPreviousSiblingBy(G);},getNextSiblingBy:function(G,Y){while(G){G=G.nextSibling;if(E.Dom._testElement(G,Y)){return G;}}return null;},getNextSibling:function(G){G=E.Dom.get(G);if(!G){return null;}return E.Dom.getNextSiblingBy(G);},getFirstChildBy:function(G,x){var Y=(E.Dom._testElement(G.firstChild,x))?G.firstChild:null;return Y||E.Dom.getNextSiblingBy(G.firstChild,x);},getFirstChild:function(G,Y){G=E.Dom.get(G);if(!G){return null;}return E.Dom.getFirstChildBy(G);},getLastChildBy:function(G,x){if(!G){return null;}var Y=(E.Dom._testElement(G.lastChild,x))?G.lastChild:null;return Y||E.Dom.getPreviousSiblingBy(G.lastChild,x);},getLastChild:function(G){G=E.Dom.get(G);return E.Dom.getLastChildBy(G);},getChildrenBy:function(Y,y){var x=E.Dom.getFirstChildBy(Y,y),G=x?[x]:[];E.Dom.getNextSiblingBy(x,function(z){if(!y||y(z)){G[G.length]=z;}return false;});return G;},getChildren:function(G){G=E.Dom.get(G);if(!G){}return E.Dom.getChildrenBy(G);},getDocumentScrollLeft:function(G){G=G||K;return Math.max(G[v].scrollLeft,G.body.scrollLeft);},getDocumentScrollTop:function(G){G=G||K;return Math.max(G[v].scrollTop,G.body.scrollTop);},insertBefore:function(Y,G){Y=E.Dom.get(Y);G=E.Dom.get(G);if(!Y||!G||!G[Z]){return null;}return G[Z].insertBefore(Y,G);},insertAfter:function(Y,G){Y=E.Dom.get(Y);G=E.Dom.get(G);if(!Y||!G||!G[Z]){return null;}if(G.nextSibling){return G[Z].insertBefore(Y,G.nextSibling);}else{return G[Z].appendChild(Y);}},getClientRegion:function(){var x=E.Dom.getDocumentScrollTop(),Y=E.Dom.getDocumentScrollLeft(),y=E.Dom.getViewportWidth()+Y,G=E.Dom.getViewportHeight()+x;return new E.Region(x,y,G,Y);},setAttribute:function(Y,G,x){E.Dom.batch(Y,E.Dom._setAttribute,{attr:G,val:x});},_setAttribute:function(x,Y){var G=E.Dom._toCamel(Y.attr),y=Y.val;if(x&&x.setAttribute){if(E.Dom.DOT_ATTRIBUTES[G]){x[G]=y;}else{G=E.Dom.CUSTOM_ATTRIBUTES[G]||G;x.setAttribute(G,y);}}else{}},getAttribute:function(Y,G){return E.Dom.batch(Y,E.Dom._getAttribute,G);},_getAttribute:function(Y,G){var x;G=E.Dom.CUSTOM_ATTRIBUTES[G]||G;if(Y&&Y.getAttribute){x=Y.getAttribute(G,2);}else{}return x;},_toCamel:function(Y){var x=d;function G(y,z){return z.toUpperCase();}return x[Y]||(x[Y]=Y.indexOf("-")===-1?Y:Y.replace(/-([a-z])/gi,G));},_getClassRegex:function(Y){var G;if(Y!==undefined){if(Y.exec){G=Y;}else{G=h[Y];if(!G){Y=Y.replace(E.Dom._patterns.CLASS_RE_TOKENS,"\\$1");G=h[Y]=new RegExp(s+Y+k,U);}}}return G;},_patterns:{ROOT_TAG:/^body|html$/i,CLASS_RE_TOKENS:/([\.\(\)\^\$\*\+\?\|\[\]\{\}\\])/g},_testElement:function(G,Y){return G&&G[l]==1&&(!Y||Y(G));},_calcBorders:function(x,y){var Y=parseInt(E.Dom[w](x,R),10)||0,G=parseInt(E.Dom[w](x,q),10)||0;if(H){if(N.test(x[C])){Y=0;G=0;}}y[0]+=G;y[1]+=Y;return y;}};var S=E.Dom[w];if(m.opera){E.Dom[w]=function(Y,G){var x=S(Y,G);if(X.test(G)){x=E.Dom.Color.toRGB(x);}return x;};}if(m.webkit){E.Dom[w]=function(Y,G){var x=S(Y,G);if(x==="rgba(0, 0, 0, 0)"){x="transparent";}return x;};}if(m.ie&&m.ie>=8&&K.documentElement.hasAttribute){E.Dom.DOT_ATTRIBUTES.type=true;}})();YAHOO.util.Region=function(C,D,A,B){this.top=C;this.y=C;this[1]=C;this.right=D;this.bottom=A;this.left=B;this.x=B;this[0]=B;
this.width=this.right-this.left;this.height=this.bottom-this.top;};YAHOO.util.Region.prototype.contains=function(A){return(A.left>=this.left&&A.right<=this.right&&A.top>=this.top&&A.bottom<=this.bottom);};YAHOO.util.Region.prototype.getArea=function(){return((this.bottom-this.top)*(this.right-this.left));};YAHOO.util.Region.prototype.intersect=function(E){var C=Math.max(this.top,E.top),D=Math.min(this.right,E.right),A=Math.min(this.bottom,E.bottom),B=Math.max(this.left,E.left);if(A>=C&&D>=B){return new YAHOO.util.Region(C,D,A,B);}else{return null;}};YAHOO.util.Region.prototype.union=function(E){var C=Math.min(this.top,E.top),D=Math.max(this.right,E.right),A=Math.max(this.bottom,E.bottom),B=Math.min(this.left,E.left);return new YAHOO.util.Region(C,D,A,B);};YAHOO.util.Region.prototype.toString=function(){return("Region {"+"top: "+this.top+", right: "+this.right+", bottom: "+this.bottom+", left: "+this.left+", height: "+this.height+", width: "+this.width+"}");};YAHOO.util.Region.getRegion=function(D){var F=YAHOO.util.Dom.getXY(D),C=F[1],E=F[0]+D.offsetWidth,A=F[1]+D.offsetHeight,B=F[0];return new YAHOO.util.Region(C,E,A,B);};YAHOO.util.Point=function(A,B){if(YAHOO.lang.isArray(A)){B=A[1];A=A[0];}YAHOO.util.Point.superclass.constructor.call(this,B,A,B,A);};YAHOO.extend(YAHOO.util.Point,YAHOO.util.Region);(function(){var B=YAHOO.util,A="clientTop",F="clientLeft",J="parentNode",K="right",W="hasLayout",I="px",U="opacity",L="auto",D="borderLeftWidth",G="borderTopWidth",P="borderRightWidth",V="borderBottomWidth",S="visible",Q="transparent",N="height",E="width",H="style",T="currentStyle",R=/^width|height$/,O=/^(\d[.\d]*)+(em|ex|px|gd|rem|vw|vh|vm|ch|mm|cm|in|pt|pc|deg|rad|ms|s|hz|khz|%){1}?/i,M={get:function(X,Z){var Y="",a=X[T][Z];if(Z===U){Y=B.Dom.getStyle(X,U);}else{if(!a||(a.indexOf&&a.indexOf(I)>-1)){Y=a;}else{if(B.Dom.IE_COMPUTED[Z]){Y=B.Dom.IE_COMPUTED[Z](X,Z);}else{if(O.test(a)){Y=B.Dom.IE.ComputedStyle.getPixel(X,Z);}else{Y=a;}}}}return Y;},getOffset:function(Z,e){var b=Z[T][e],X=e.charAt(0).toUpperCase()+e.substr(1),c="offset"+X,Y="pixel"+X,a="",d;if(b==L){d=Z[c];if(d===undefined){a=0;}a=d;if(R.test(e)){Z[H][e]=d;if(Z[c]>d){a=d-(Z[c]-d);}Z[H][e]=L;}}else{if(!Z[H][Y]&&!Z[H][e]){Z[H][e]=b;}a=Z[H][Y];}return a+I;},getBorderWidth:function(X,Z){var Y=null;if(!X[T][W]){X[H].zoom=1;}switch(Z){case G:Y=X[A];break;case V:Y=X.offsetHeight-X.clientHeight-X[A];break;case D:Y=X[F];break;case P:Y=X.offsetWidth-X.clientWidth-X[F];break;}return Y+I;},getPixel:function(Y,X){var a=null,b=Y[T][K],Z=Y[T][X];Y[H][K]=Z;a=Y[H].pixelRight;Y[H][K]=b;return a+I;},getMargin:function(Y,X){var Z;if(Y[T][X]==L){Z=0+I;}else{Z=B.Dom.IE.ComputedStyle.getPixel(Y,X);}return Z;},getVisibility:function(Y,X){var Z;while((Z=Y[T])&&Z[X]=="inherit"){Y=Y[J];}return(Z)?Z[X]:S;},getColor:function(Y,X){return B.Dom.Color.toRGB(Y[T][X])||Q;},getBorderColor:function(Y,X){var Z=Y[T],a=Z[X]||Z.color;return B.Dom.Color.toRGB(B.Dom.Color.toHex(a));}},C={};C.top=C.right=C.bottom=C.left=C[E]=C[N]=M.getOffset;C.color=M.getColor;C[G]=C[P]=C[V]=C[D]=M.getBorderWidth;C.marginTop=C.marginRight=C.marginBottom=C.marginLeft=M.getMargin;C.visibility=M.getVisibility;C.borderColor=C.borderTopColor=C.borderRightColor=C.borderBottomColor=C.borderLeftColor=M.getBorderColor;B.Dom.IE_COMPUTED=C;B.Dom.IE_ComputedStyle=M;})();(function(){var C="toString",A=parseInt,B=RegExp,D=YAHOO.util;D.Dom.Color={KEYWORDS:{black:"000",silver:"c0c0c0",gray:"808080",white:"fff",maroon:"800000",red:"f00",purple:"800080",fuchsia:"f0f",green:"008000",lime:"0f0",olive:"808000",yellow:"ff0",navy:"000080",blue:"00f",teal:"008080",aqua:"0ff"},re_RGB:/^rgb\(([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)\)$/i,re_hex:/^#?([0-9A-F]{2})([0-9A-F]{2})([0-9A-F]{2})$/i,re_hex3:/([0-9A-F])/gi,toRGB:function(E){if(!D.Dom.Color.re_RGB.test(E)){E=D.Dom.Color.toHex(E);}if(D.Dom.Color.re_hex.exec(E)){E="rgb("+[A(B.$1,16),A(B.$2,16),A(B.$3,16)].join(", ")+")";}return E;},toHex:function(H){H=D.Dom.Color.KEYWORDS[H]||H;if(D.Dom.Color.re_RGB.exec(H)){var G=(B.$1.length===1)?"0"+B.$1:Number(B.$1),F=(B.$2.length===1)?"0"+B.$2:Number(B.$2),E=(B.$3.length===1)?"0"+B.$3:Number(B.$3);H=[G[C](16),F[C](16),E[C](16)].join("");}if(H.length<6){H=H.replace(D.Dom.Color.re_hex3,"$1$1");}if(H!=="transparent"&&H.indexOf("#")<0){H="#"+H;}return H.toLowerCase();}};}());YAHOO.register("dom",YAHOO.util.Dom,{version:"2.8.1",build:"19"});YAHOO.util.CustomEvent=function(D,C,B,A,E){this.type=D;this.scope=C||window;this.silent=B;this.fireOnce=E;this.fired=false;this.firedWith=null;this.signature=A||YAHOO.util.CustomEvent.LIST;this.subscribers=[];if(!this.silent){}var F="_YUICEOnSubscribe";if(D!==F){this.subscribeEvent=new YAHOO.util.CustomEvent(F,this,true);}this.lastError=null;};YAHOO.util.CustomEvent.LIST=0;YAHOO.util.CustomEvent.FLAT=1;YAHOO.util.CustomEvent.prototype={subscribe:function(B,C,D){if(!B){throw new Error("Invalid callback for subscriber to '"+this.type+"'");}if(this.subscribeEvent){this.subscribeEvent.fire(B,C,D);}var A=new YAHOO.util.Subscriber(B,C,D);if(this.fireOnce&&this.fired){this.notify(A,this.firedWith);}else{this.subscribers.push(A);}},unsubscribe:function(D,F){if(!D){return this.unsubscribeAll();}var E=false;for(var B=0,A=this.subscribers.length;B<A;++B){var C=this.subscribers[B];if(C&&C.contains(D,F)){this._delete(B);E=true;}}return E;},fire:function(){this.lastError=null;var H=[],A=this.subscribers.length;var D=[].slice.call(arguments,0),C=true,F,B=false;if(this.fireOnce){if(this.fired){return true;}else{this.firedWith=D;}}this.fired=true;if(!A&&this.silent){return true;}if(!this.silent){}var E=this.subscribers.slice();for(F=0;F<A;++F){var G=E[F];if(!G){B=true;}else{C=this.notify(G,D);if(false===C){if(!this.silent){}break;}}}return(C!==false);},notify:function(F,C){var B,H=null,E=F.getScope(this.scope),A=YAHOO.util.Event.throwErrors;if(!this.silent){}if(this.signature==YAHOO.util.CustomEvent.FLAT){if(C.length>0){H=C[0];}try{B=F.fn.call(E,H,F.obj);}catch(G){this.lastError=G;if(A){throw G;}}}else{try{B=F.fn.call(E,this.type,C,F.obj);}catch(D){this.lastError=D;if(A){throw D;}}}return B;},unsubscribeAll:function(){var A=this.subscribers.length,B;for(B=A-1;B>-1;B--){this._delete(B);}this.subscribers=[];return A;},_delete:function(A){var B=this.subscribers[A];if(B){delete B.fn;delete B.obj;}this.subscribers.splice(A,1);},toString:function(){return"CustomEvent: "+"'"+this.type+"', "+"context: "+this.scope;}};YAHOO.util.Subscriber=function(A,B,C){this.fn=A;this.obj=YAHOO.lang.isUndefined(B)?null:B;this.overrideContext=C;};YAHOO.util.Subscriber.prototype.getScope=function(A){if(this.overrideContext){if(this.overrideContext===true){return this.obj;}else{return this.overrideContext;}}return A;};YAHOO.util.Subscriber.prototype.contains=function(A,B){if(B){return(this.fn==A&&this.obj==B);}else{return(this.fn==A);}};YAHOO.util.Subscriber.prototype.toString=function(){return"Subscriber { obj: "+this.obj+", overrideContext: "+(this.overrideContext||"no")+" }";};if(!YAHOO.util.Event){YAHOO.util.Event=function(){var G=false,H=[],J=[],A=0,E=[],B=0,C={63232:38,63233:40,63234:37,63235:39,63276:33,63277:34,25:9},D=YAHOO.env.ua.ie,F="focusin",I="focusout";return{POLL_RETRYS:500,POLL_INTERVAL:40,EL:0,TYPE:1,FN:2,WFN:3,UNLOAD_OBJ:3,ADJ_SCOPE:4,OBJ:5,OVERRIDE:6,CAPTURE:7,lastError:null,isSafari:YAHOO.env.ua.webkit,webkit:YAHOO.env.ua.webkit,isIE:D,_interval:null,_dri:null,_specialTypes:{focusin:(D?"focusin":"focus"),focusout:(D?"focusout":"blur")},DOMReady:false,throwErrors:false,startInterval:function(){if(!this._interval){this._interval=YAHOO.lang.later(this.POLL_INTERVAL,this,this._tryPreloadAttach,null,true);}},onAvailable:function(Q,M,O,P,N){var K=(YAHOO.lang.isString(Q))?[Q]:Q;for(var L=0;L<K.length;L=L+1){E.push({id:K[L],fn:M,obj:O,overrideContext:P,checkReady:N});}A=this.POLL_RETRYS;this.startInterval();},onContentReady:function(N,K,L,M){this.onAvailable(N,K,L,M,true);},onDOMReady:function(){this.DOMReadyEvent.subscribe.apply(this.DOMReadyEvent,arguments);},_addListener:function(M,K,V,P,T,Y){if(!V||!V.call){return false;}if(this._isValidCollection(M)){var W=true;for(var Q=0,S=M.length;Q<S;++Q){W=this.on(M[Q],K,V,P,T)&&W;}return W;}else{if(YAHOO.lang.isString(M)){var O=this.getEl(M);if(O){M=O;}else{this.onAvailable(M,function(){YAHOO.util.Event._addListener(M,K,V,P,T,Y);});return true;}}}if(!M){return false;}if("unload"==K&&P!==this){J[J.length]=[M,K,V,P,T];return true;}var L=M;if(T){if(T===true){L=P;}else{L=T;}}var N=function(Z){return V.call(L,YAHOO.util.Event.getEvent(Z,M),P);};var X=[M,K,V,N,L,P,T,Y];var R=H.length;H[R]=X;try{this._simpleAdd(M,K,N,Y);}catch(U){this.lastError=U;this.removeListener(M,K,V);return false;}return true;},_getType:function(K){return this._specialTypes[K]||K;},addListener:function(M,P,L,N,O){var K=((P==F||P==I)&&!YAHOO.env.ua.ie)?true:false;return this._addListener(M,this._getType(P),L,N,O,K);},addFocusListener:function(L,K,M,N){return this.on(L,F,K,M,N);},removeFocusListener:function(L,K){return this.removeListener(L,F,K);},addBlurListener:function(L,K,M,N){return this.on(L,I,K,M,N);},removeBlurListener:function(L,K){return this.removeListener(L,I,K);},removeListener:function(L,K,R){var M,P,U;K=this._getType(K);if(typeof L=="string"){L=this.getEl(L);}else{if(this._isValidCollection(L)){var S=true;for(M=L.length-1;M>-1;M--){S=(this.removeListener(L[M],K,R)&&S);}return S;}}if(!R||!R.call){return this.purgeElement(L,false,K);}if("unload"==K){for(M=J.length-1;M>-1;M--){U=J[M];if(U&&U[0]==L&&U[1]==K&&U[2]==R){J.splice(M,1);return true;}}return false;}var N=null;var O=arguments[3];if("undefined"===typeof O){O=this._getCacheIndex(H,L,K,R);}if(O>=0){N=H[O];}if(!L||!N){return false;}var T=N[this.CAPTURE]===true?true:false;try{this._simpleRemove(L,K,N[this.WFN],T);}catch(Q){this.lastError=Q;return false;}delete H[O][this.WFN];delete H[O][this.FN];H.splice(O,1);return true;},getTarget:function(M,L){var K=M.target||M.srcElement;return this.resolveTextNode(K);},resolveTextNode:function(L){try{if(L&&3==L.nodeType){return L.parentNode;}}catch(K){}return L;},getPageX:function(L){var K=L.pageX;if(!K&&0!==K){K=L.clientX||0;if(this.isIE){K+=this._getScrollLeft();}}return K;},getPageY:function(K){var L=K.pageY;if(!L&&0!==L){L=K.clientY||0;if(this.isIE){L+=this._getScrollTop();}}return L;},getXY:function(K){return[this.getPageX(K),this.getPageY(K)];},getRelatedTarget:function(L){var K=L.relatedTarget;if(!K){if(L.type=="mouseout"){K=L.toElement;
}else{if(L.type=="mouseover"){K=L.fromElement;}}}return this.resolveTextNode(K);},getTime:function(M){if(!M.time){var L=new Date().getTime();try{M.time=L;}catch(K){this.lastError=K;return L;}}return M.time;},stopEvent:function(K){this.stopPropagation(K);this.preventDefault(K);},stopPropagation:function(K){if(K.stopPropagation){K.stopPropagation();}else{K.cancelBubble=true;}},preventDefault:function(K){if(K.preventDefault){K.preventDefault();}else{K.returnValue=false;}},getEvent:function(M,K){var L=M||window.event;if(!L){var N=this.getEvent.caller;while(N){L=N.arguments[0];if(L&&Event==L.constructor){break;}N=N.caller;}}return L;},getCharCode:function(L){var K=L.keyCode||L.charCode||0;if(YAHOO.env.ua.webkit&&(K in C)){K=C[K];}return K;},_getCacheIndex:function(M,P,Q,O){for(var N=0,L=M.length;N<L;N=N+1){var K=M[N];if(K&&K[this.FN]==O&&K[this.EL]==P&&K[this.TYPE]==Q){return N;}}return -1;},generateId:function(K){var L=K.id;if(!L){L="yuievtautoid-"+B;++B;K.id=L;}return L;},_isValidCollection:function(L){try{return(L&&typeof L!=="string"&&L.length&&!L.tagName&&!L.alert&&typeof L[0]!=="undefined");}catch(K){return false;}},elCache:{},getEl:function(K){return(typeof K==="string")?document.getElementById(K):K;},clearCache:function(){},DOMReadyEvent:new YAHOO.util.CustomEvent("DOMReady",YAHOO,0,0,1),_load:function(L){if(!G){G=true;var K=YAHOO.util.Event;K._ready();K._tryPreloadAttach();}},_ready:function(L){var K=YAHOO.util.Event;if(!K.DOMReady){K.DOMReady=true;K.DOMReadyEvent.fire();K._simpleRemove(document,"DOMContentLoaded",K._ready);}},_tryPreloadAttach:function(){if(E.length===0){A=0;if(this._interval){this._interval.cancel();this._interval=null;}return;}if(this.locked){return;}if(this.isIE){if(!this.DOMReady){this.startInterval();return;}}this.locked=true;var Q=!G;if(!Q){Q=(A>0&&E.length>0);}var P=[];var R=function(T,U){var S=T;if(U.overrideContext){if(U.overrideContext===true){S=U.obj;}else{S=U.overrideContext;}}U.fn.call(S,U.obj);};var L,K,O,N,M=[];for(L=0,K=E.length;L<K;L=L+1){O=E[L];if(O){N=this.getEl(O.id);if(N){if(O.checkReady){if(G||N.nextSibling||!Q){M.push(O);E[L]=null;}}else{R(N,O);E[L]=null;}}else{P.push(O);}}}for(L=0,K=M.length;L<K;L=L+1){O=M[L];R(this.getEl(O.id),O);}A--;if(Q){for(L=E.length-1;L>-1;L--){O=E[L];if(!O||!O.id){E.splice(L,1);}}this.startInterval();}else{if(this._interval){this._interval.cancel();this._interval=null;}}this.locked=false;},purgeElement:function(O,P,R){var M=(YAHOO.lang.isString(O))?this.getEl(O):O;var Q=this.getListeners(M,R),N,K;if(Q){for(N=Q.length-1;N>-1;N--){var L=Q[N];this.removeListener(M,L.type,L.fn);}}if(P&&M&&M.childNodes){for(N=0,K=M.childNodes.length;N<K;++N){this.purgeElement(M.childNodes[N],P,R);}}},getListeners:function(M,K){var P=[],L;if(!K){L=[H,J];}else{if(K==="unload"){L=[J];}else{K=this._getType(K);L=[H];}}var R=(YAHOO.lang.isString(M))?this.getEl(M):M;for(var O=0;O<L.length;O=O+1){var T=L[O];if(T){for(var Q=0,S=T.length;Q<S;++Q){var N=T[Q];if(N&&N[this.EL]===R&&(!K||K===N[this.TYPE])){P.push({type:N[this.TYPE],fn:N[this.FN],obj:N[this.OBJ],adjust:N[this.OVERRIDE],scope:N[this.ADJ_SCOPE],index:Q});}}}}return(P.length)?P:null;},_unload:function(R){var L=YAHOO.util.Event,O,N,M,Q,P,S=J.slice(),K;for(O=0,Q=J.length;O<Q;++O){M=S[O];if(M){K=window;if(M[L.ADJ_SCOPE]){if(M[L.ADJ_SCOPE]===true){K=M[L.UNLOAD_OBJ];}else{K=M[L.ADJ_SCOPE];}}M[L.FN].call(K,L.getEvent(R,M[L.EL]),M[L.UNLOAD_OBJ]);S[O]=null;}}M=null;K=null;J=null;if(H){for(N=H.length-1;N>-1;N--){M=H[N];if(M){L.removeListener(M[L.EL],M[L.TYPE],M[L.FN],N);}}M=null;}L._simpleRemove(window,"unload",L._unload);},_getScrollLeft:function(){return this._getScroll()[1];},_getScrollTop:function(){return this._getScroll()[0];},_getScroll:function(){var K=document.documentElement,L=document.body;if(K&&(K.scrollTop||K.scrollLeft)){return[K.scrollTop,K.scrollLeft];}else{if(L){return[L.scrollTop,L.scrollLeft];}else{return[0,0];}}},regCE:function(){},_simpleAdd:function(){if(window.addEventListener){return function(M,N,L,K){M.addEventListener(N,L,(K));};}else{if(window.attachEvent){return function(M,N,L,K){M.attachEvent("on"+N,L);};}else{return function(){};}}}(),_simpleRemove:function(){if(window.removeEventListener){return function(M,N,L,K){M.removeEventListener(N,L,(K));};}else{if(window.detachEvent){return function(L,M,K){L.detachEvent("on"+M,K);};}else{return function(){};}}}()};}();(function(){var EU=YAHOO.util.Event;EU.on=EU.addListener;EU.onFocus=EU.addFocusListener;EU.onBlur=EU.addBlurListener;
/* DOMReady: based on work by: Dean Edwards/John Resig/Matthias Miller/Diego Perini */
if(EU.isIE){if(self!==self.top){document.onreadystatechange=function(){if(document.readyState=="complete"){document.onreadystatechange=null;EU._ready();}};}else{YAHOO.util.Event.onDOMReady(YAHOO.util.Event._tryPreloadAttach,YAHOO.util.Event,true);var n=document.createElement("p");EU._dri=setInterval(function(){try{n.doScroll("left");clearInterval(EU._dri);EU._dri=null;EU._ready();n=null;}catch(ex){}},EU.POLL_INTERVAL);}}else{if(EU.webkit&&EU.webkit<525){EU._dri=setInterval(function(){var rs=document.readyState;if("loaded"==rs||"complete"==rs){clearInterval(EU._dri);EU._dri=null;EU._ready();}},EU.POLL_INTERVAL);}else{EU._simpleAdd(document,"DOMContentLoaded",EU._ready);}}EU._simpleAdd(window,"load",EU._load);EU._simpleAdd(window,"unload",EU._unload);EU._tryPreloadAttach();})();}YAHOO.util.EventProvider=function(){};YAHOO.util.EventProvider.prototype={__yui_events:null,__yui_subscribers:null,subscribe:function(A,C,F,E){this.__yui_events=this.__yui_events||{};var D=this.__yui_events[A];if(D){D.subscribe(C,F,E);}else{this.__yui_subscribers=this.__yui_subscribers||{};var B=this.__yui_subscribers;if(!B[A]){B[A]=[];}B[A].push({fn:C,obj:F,overrideContext:E});}},unsubscribe:function(C,E,G){this.__yui_events=this.__yui_events||{};var A=this.__yui_events;if(C){var F=A[C];if(F){return F.unsubscribe(E,G);}}else{var B=true;for(var D in A){if(YAHOO.lang.hasOwnProperty(A,D)){B=B&&A[D].unsubscribe(E,G);}}return B;}return false;},unsubscribeAll:function(A){return this.unsubscribe(A);
},createEvent:function(B,G){this.__yui_events=this.__yui_events||{};var E=G||{},D=this.__yui_events,F;if(D[B]){}else{F=new YAHOO.util.CustomEvent(B,E.scope||this,E.silent,YAHOO.util.CustomEvent.FLAT,E.fireOnce);D[B]=F;if(E.onSubscribeCallback){F.subscribeEvent.subscribe(E.onSubscribeCallback);}this.__yui_subscribers=this.__yui_subscribers||{};var A=this.__yui_subscribers[B];if(A){for(var C=0;C<A.length;++C){F.subscribe(A[C].fn,A[C].obj,A[C].overrideContext);}}}return D[B];},fireEvent:function(B){this.__yui_events=this.__yui_events||{};var D=this.__yui_events[B];if(!D){return null;}var A=[];for(var C=1;C<arguments.length;++C){A.push(arguments[C]);}return D.fire.apply(D,A);},hasEvent:function(A){if(this.__yui_events){if(this.__yui_events[A]){return true;}}return false;}};(function(){var A=YAHOO.util.Event,C=YAHOO.lang;YAHOO.util.KeyListener=function(D,I,E,F){if(!D){}else{if(!I){}else{if(!E){}}}if(!F){F=YAHOO.util.KeyListener.KEYDOWN;}var G=new YAHOO.util.CustomEvent("keyPressed");this.enabledEvent=new YAHOO.util.CustomEvent("enabled");this.disabledEvent=new YAHOO.util.CustomEvent("disabled");if(C.isString(D)){D=document.getElementById(D);}if(C.isFunction(E)){G.subscribe(E);}else{G.subscribe(E.fn,E.scope,E.correctScope);}function H(O,N){if(!I.shift){I.shift=false;}if(!I.alt){I.alt=false;}if(!I.ctrl){I.ctrl=false;}if(O.shiftKey==I.shift&&O.altKey==I.alt&&O.ctrlKey==I.ctrl){var J,M=I.keys,L;if(YAHOO.lang.isArray(M)){for(var K=0;K<M.length;K++){J=M[K];L=A.getCharCode(O);if(J==L){G.fire(L,O);break;}}}else{L=A.getCharCode(O);if(M==L){G.fire(L,O);}}}}this.enable=function(){if(!this.enabled){A.on(D,F,H);this.enabledEvent.fire(I);}this.enabled=true;};this.disable=function(){if(this.enabled){A.removeListener(D,F,H);this.disabledEvent.fire(I);}this.enabled=false;};this.toString=function(){return"KeyListener ["+I.keys+"] "+D.tagName+(D.id?"["+D.id+"]":"");};};var B=YAHOO.util.KeyListener;B.KEYDOWN="keydown";B.KEYUP="keyup";B.KEY={ALT:18,BACK_SPACE:8,CAPS_LOCK:20,CONTROL:17,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,LEFT:37,META:224,NUM_LOCK:144,PAGE_DOWN:34,PAGE_UP:33,PAUSE:19,PRINTSCREEN:44,RIGHT:39,SCROLL_LOCK:145,SHIFT:16,SPACE:32,TAB:9,UP:38};})();YAHOO.register("event",YAHOO.util.Event,{version:"2.8.1",build:"19"});YAHOO.register("yahoo-dom-event", YAHOO, {version: "2.8.1", build: "19"});/*
Copyright (c) 2010, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.com/yui/license.html
version: 2.8.1
*/
/**
 * The Connection Manager provides a simplified interface to the XMLHttpRequest
 * object.  It handles cross-browser instantiantion of XMLHttpRequest, negotiates the
 * interactive states and server response, returning the results to a pre-defined
 * callback you create.
 *
 * @namespace YAHOO.util
 * @module connection
 * @requires yahoo
 * @requires event
 */

/**
 * The Connection Manager singleton provides methods for creating and managing
 * asynchronous transactions.
 *
 * @class Connect
 */

YAHOO.util.Connect =
{
  /**
   * @description Array of MSFT ActiveX ids for XMLHttpRequest.
   * @property _msxml_progid
   * @private
   * @static
   * @type array
   */
	_msxml_progid:[
		'Microsoft.XMLHTTP',
		'MSXML2.XMLHTTP.3.0',
		'MSXML2.XMLHTTP'
		],

  /**
   * @description Object literal of HTTP header(s)
   * @property _http_header
   * @private
   * @static
   * @type object
   */
	_http_headers:{},

  /**
   * @description Determines if HTTP headers are set.
   * @property _has_http_headers
   * @private
   * @static
   * @type boolean
   */
	_has_http_headers:false,

 /**
  * @description Determines if a default header of
  * Content-Type of 'application/x-www-form-urlencoded'
  * will be added to any client HTTP headers sent for POST
  * transactions.
  * @property _use_default_post_header
  * @private
  * @static
  * @type boolean
  */
    _use_default_post_header:true,

 /**
  * @description The default header used for POST transactions.
  * @property _default_post_header
  * @private
  * @static
  * @type boolean
  */
    _default_post_header:'application/x-www-form-urlencoded; charset=UTF-8',

 /**
  * @description The default header used for transactions involving the
  * use of HTML forms.
  * @property _default_form_header
  * @private
  * @static
  * @type boolean
  */
    _default_form_header:'application/x-www-form-urlencoded',

 /**
  * @description Determines if a default header of
  * 'X-Requested-With: XMLHttpRequest'
  * will be added to each transaction.
  * @property _use_default_xhr_header
  * @private
  * @static
  * @type boolean
  */
    _use_default_xhr_header:true,

 /**
  * @description The default header value for the label
  * "X-Requested-With".  This is sent with each
  * transaction, by default, to identify the
  * request as being made by YUI Connection Manager.
  * @property _default_xhr_header
  * @private
  * @static
  * @type boolean
  */
    _default_xhr_header:'XMLHttpRequest',

 /**
  * @description Determines if custom, default headers
  * are set for each transaction.
  * @property _has_default_header
  * @private
  * @static
  * @type boolean
  */
    _has_default_headers:true,

 /**
  * @description Determines if custom, default headers
  * are set for each transaction.
  * @property _has_default_header
  * @private
  * @static
  * @type boolean
  */
    _default_headers:{},

 /**
  * @description Collection of polling references to the polling mechanism in handleReadyState.
  * @property _poll
  * @private
  * @static
  * @type object
  */
    _poll:{},

 /**
  * @description Queue of timeout values for each transaction callback with a defined timeout value.
  * @property _timeOut
  * @private
  * @static
  * @type object
  */
    _timeOut:{},

  /**
   * @description The polling frequency, in milliseconds, for HandleReadyState.
   * when attempting to determine a transaction's XHR readyState.
   * The default is 50 milliseconds.
   * @property _polling_interval
   * @private
   * @static
   * @type int
   */
     _polling_interval:50,

  /**
   * @description A transaction counter that increments the transaction id for each transaction.
   * @property _transaction_id
   * @private
   * @static
   * @type int
   */
     _transaction_id:0,

  /**
   * @description Custom event that fires at the start of a transaction
   * @property startEvent
   * @private
   * @static
   * @type CustomEvent
   */
	startEvent: new YAHOO.util.CustomEvent('start'),

  /**
   * @description Custom event that fires when a transaction response has completed.
   * @property completeEvent
   * @private
   * @static
   * @type CustomEvent
   */
	completeEvent: new YAHOO.util.CustomEvent('complete'),

  /**
   * @description Custom event that fires when handleTransactionResponse() determines a
   * response in the HTTP 2xx range.
   * @property successEvent
   * @private
   * @static
   * @type CustomEvent
   */
	successEvent: new YAHOO.util.CustomEvent('success'),

  /**
   * @description Custom event that fires when handleTransactionResponse() determines a
   * response in the HTTP 4xx/5xx range.
   * @property failureEvent
   * @private
   * @static
   * @type CustomEvent
   */
	failureEvent: new YAHOO.util.CustomEvent('failure'),

  /**
   * @description Custom event that fires when a transaction is successfully aborted.
   * @property abortEvent
   * @private
   * @static
   * @type CustomEvent
   */
	abortEvent: new YAHOO.util.CustomEvent('abort'),

  /**
   * @description A reference table that maps callback custom events members to its specific
   * event name.
   * @property _customEvents
   * @private
   * @static
   * @type object
   */
	_customEvents:
	{
		onStart:['startEvent', 'start'],
		onComplete:['completeEvent', 'complete'],
		onSuccess:['successEvent', 'success'],
		onFailure:['failureEvent', 'failure'],
		onUpload:['uploadEvent', 'upload'],
		onAbort:['abortEvent', 'abort']
	},

  /**
   * @description Member to add an ActiveX id to the existing xml_progid array.
   * In the event(unlikely) a new ActiveX id is introduced, it can be added
   * without internal code modifications.
   * @method setProgId
   * @public
   * @static
   * @param {string} id The ActiveX id to be added to initialize the XHR object.
   * @return void
   */
	setProgId:function(id)
	{
		this._msxml_progid.unshift(id);
		YAHOO.log('ActiveX Program Id  ' + id + ' added to _msxml_progid.', 'info', 'Connection');
	},

  /**
   * @description Member to override the default POST header.
   * @method setDefaultPostHeader
   * @public
   * @static
   * @param {boolean} b Set and use default header - true or false .
   * @return void
   */
	setDefaultPostHeader:function(b)
	{
		if(typeof b == 'string'){
			this._default_post_header = b;
			YAHOO.log('Default POST header set to  ' + b, 'info', 'Connection');
		}
		else if(typeof b == 'boolean'){
			this._use_default_post_header = b;
		}
	},

  /**
   * @description Member to override the default transaction header..
   * @method setDefaultXhrHeader
   * @public
   * @static
   * @param {boolean} b Set and use default header - true or false .
   * @return void
   */
	setDefaultXhrHeader:function(b)
	{
		if(typeof b == 'string'){
			this._default_xhr_header = b;
			YAHOO.log('Default XHR header set to  ' + b, 'info', 'Connection');
		}
		else{
			this._use_default_xhr_header = b;
		}
	},

  /**
   * @description Member to modify the default polling interval.
   * @method setPollingInterval
   * @public
   * @static
   * @param {int} i The polling interval in milliseconds.
   * @return void
   */
	setPollingInterval:function(i)
	{
		if(typeof i == 'number' && isFinite(i)){
			this._polling_interval = i;
			YAHOO.log('Default polling interval set to ' + i +'ms', 'info', 'Connection');
		}
	},

  /**
   * @description Instantiates a XMLHttpRequest object and returns an object with two properties:
   * the XMLHttpRequest instance and the transaction id.
   * @method createXhrObject
   * @private
   * @static
   * @param {int} transactionId Property containing the transaction id for this transaction.
   * @return object
   */
	createXhrObject:function(transactionId)
	{
		var obj,http,i;
		try
		{
			// Instantiates XMLHttpRequest in non-IE browsers and assigns to http.
			http = new XMLHttpRequest();
			//  Object literal with http and tId properties
			obj = { conn:http, tId:transactionId, xhr: true };
			YAHOO.log('XHR object created for transaction ' + transactionId, 'info', 'Connection');
		}
		catch(e)
		{
			for(i=0; i<this._msxml_progid.length; ++i){
				try
				{
					// Instantiates XMLHttpRequest for IE and assign to http
					http = new ActiveXObject(this._msxml_progid[i]);
					//  Object literal with conn and tId properties
					obj = { conn:http, tId:transactionId, xhr: true };
					YAHOO.log('ActiveX XHR object created for transaction ' + transactionId, 'info', 'Connection');
					break;
				}
				catch(e1){}
			}
		}
		finally
		{
			return obj;
		}
	},

  /**
   * @description This method is called by asyncRequest to create a
   * valid connection object for the transaction.  It also passes a
   * transaction id and increments the transaction id counter.
   * @method getConnectionObject
   * @private
   * @static
   * @return {object}
   */
	getConnectionObject:function(t)
	{
		var o, tId = this._transaction_id;

		try
		{
			if(!t){
				o = this.createXhrObject(tId);
			}
			else{
				o = {tId:tId};
				if(t==='xdr'){
					o.conn = this._transport;
					o.xdr = true;
				}
				else if(t==='upload'){
					o.upload = true;
				}
			}

			if(o){
				this._transaction_id++;
			}
		}
		catch(e){}
		return o;
	},

  /**
   * @description Method for initiating an asynchronous request via the XHR object.
   * @method asyncRequest
   * @public
   * @static
   * @param {string} method HTTP transaction method
   * @param {string} uri Fully qualified path of resource
   * @param {callback} callback User-defined callback function or object
   * @param {string} postData POST body
   * @return {object} Returns the connection object
   */
	asyncRequest:function(method, uri, callback, postData)
	{
		var o,t,args = (callback && callback.argument)?callback.argument:null;

		if(this._isFileUpload){
			t = 'upload';
		}
		else if(callback.xdr){
			t = 'xdr';
		}

		o = this.getConnectionObject(t);
		if(!o){
			YAHOO.log('Unable to create connection object.', 'error', 'Connection');
			return null;
		}
		else{

			// Intialize any transaction-specific custom events, if provided.
			if(callback && callback.customevents){
				this.initCustomEvents(o, callback);
			}

			if(this._isFormSubmit){
				if(this._isFileUpload){
					this.uploadFile(o, callback, uri, postData);
					return o;
				}

				// If the specified HTTP method is GET, setForm() will return an
				// encoded string that is concatenated to the uri to
				// create a querystring.
				if(method.toUpperCase() == 'GET'){
					if(this._sFormData.length !== 0){
						// If the URI already contains a querystring, append an ampersand
						// and then concatenate _sFormData to the URI.
						uri += ((uri.indexOf('?') == -1)?'?':'&') + this._sFormData;
					}
				}
				else if(method.toUpperCase() == 'POST'){
					// If POST data exist in addition to the HTML form data,
					// it will be concatenated to the form data.
					postData = postData?this._sFormData + "&" + postData:this._sFormData;
				}
			}

			if(method.toUpperCase() == 'GET' && (callback && callback.cache === false)){
				// If callback.cache is defined and set to false, a
				// timestamp value will be added to the querystring.
				uri += ((uri.indexOf('?') == -1)?'?':'&') + "rnd=" + new Date().valueOf().toString();
			}

			// Each transaction will automatically include a custom header of
			// "X-Requested-With: XMLHttpRequest" to identify the request as
			// having originated from Connection Manager.
			if(this._use_default_xhr_header){
				if(!this._default_headers['X-Requested-With']){
					this.initHeader('X-Requested-With', this._default_xhr_header, true);
					YAHOO.log('Initialize transaction header X-Request-Header to XMLHttpRequest.', 'info', 'Connection');
				}
			}

			//If the transaction method is POST and the POST header value is set to true
			//or a custom value, initalize the Content-Type header to this value.
			if((method.toUpperCase() === 'POST' && this._use_default_post_header) && this._isFormSubmit === false){
				this.initHeader('Content-Type', this._default_post_header);
				YAHOO.log('Initialize header Content-Type to application/x-www-form-urlencoded; UTF-8 for POST transaction.', 'info', 'Connection');
			}

			if(o.xdr){
				this.xdr(o, method, uri, callback, postData);
				return o;
			}

			o.conn.open(method, uri, true);
			//Initialize all default and custom HTTP headers,
			if(this._has_default_headers || this._has_http_headers){
				this.setHeader(o);
			}

			this.handleReadyState(o, callback);
			o.conn.send(postData || '');
			YAHOO.log('Transaction ' + o.tId + ' sent.', 'info', 'Connection');

			// Reset the HTML form data and state properties as
			// soon as the data are submitted.
			if(this._isFormSubmit === true){
				this.resetFormState();
			}

			// Fire global custom event -- startEvent
			this.startEvent.fire(o, args);

			if(o.startEvent){
				// Fire transaction custom event -- startEvent
				o.startEvent.fire(o, args);
			}

			return o;
		}
	},

  /**
   * @description This method creates and subscribes custom events,
   * specific to each transaction
   * @method initCustomEvents
   * @private
   * @static
   * @param {object} o The connection object
   * @param {callback} callback The user-defined callback object
   * @return {void}
   */
	initCustomEvents:function(o, callback)
	{
		var prop;
		// Enumerate through callback.customevents members and bind/subscribe
		// events that match in the _customEvents table.
		for(prop in callback.customevents){
			if(this._customEvents[prop][0]){
				// Create the custom event
				o[this._customEvents[prop][0]] = new YAHOO.util.CustomEvent(this._customEvents[prop][1], (callback.scope)?callback.scope:null);
				YAHOO.log('Transaction-specific Custom Event ' + o[this._customEvents[prop][1]] + ' created.', 'info', 'Connection');

				// Subscribe the custom event
				o[this._customEvents[prop][0]].subscribe(callback.customevents[prop]);
				YAHOO.log('Transaction-specific Custom Event ' + o[this._customEvents[prop][1]] + ' subscribed.', 'info', 'Connection');
			}
		}
	},

  /**
   * @description This method serves as a timer that polls the XHR object's readyState
   * property during a transaction, instead of binding a callback to the
   * onreadystatechange event.  Upon readyState 4, handleTransactionResponse
   * will process the response, and the timer will be cleared.
   * @method handleReadyState
   * @private
   * @static
   * @param {object} o The connection object
   * @param {callback} callback The user-defined callback object
   * @return {void}
   */

    handleReadyState:function(o, callback)

    {
		var oConn = this,
			args = (callback && callback.argument)?callback.argument:null;

		if(callback && callback.timeout){
			this._timeOut[o.tId] = window.setTimeout(function(){ oConn.abort(o, callback, true); }, callback.timeout);
		}

		this._poll[o.tId] = window.setInterval(
			function(){
				if(o.conn && o.conn.readyState === 4){

					// Clear the polling interval for the transaction
					// and remove the reference from _poll.
					window.clearInterval(oConn._poll[o.tId]);
					delete oConn._poll[o.tId];

					if(callback && callback.timeout){
						window.clearTimeout(oConn._timeOut[o.tId]);
						delete oConn._timeOut[o.tId];
					}

					// Fire global custom event -- completeEvent
					oConn.completeEvent.fire(o, args);

					if(o.completeEvent){
						// Fire transaction custom event -- completeEvent
						o.completeEvent.fire(o, args);
					}

					oConn.handleTransactionResponse(o, callback);
				}
			}
		,this._polling_interval);
    },

  /**
   * @description This method attempts to interpret the server response and
   * determine whether the transaction was successful, or if an error or
   * exception was encountered.
   * @method handleTransactionResponse
   * @private
   * @static
   * @param {object} o The connection object
   * @param {object} callback The user-defined callback object
   * @param {boolean} isAbort Determines if the transaction was terminated via abort().
   * @return {void}
   */
    handleTransactionResponse:function(o, callback, isAbort)
    {
		var httpStatus, responseObject,
			args = (callback && callback.argument)?callback.argument:null,
			xdrS = (o.r && o.r.statusText === 'xdr:success')?true:false,
			xdrF = (o.r && o.r.statusText === 'xdr:failure')?true:false,
			xdrA = isAbort;

		try
		{
			if((o.conn.status !== undefined && o.conn.status !== 0) || xdrS){
				// XDR requests will not have HTTP status defined. The
				// statusText property will define the response status
				// set by the Flash transport.
				httpStatus = o.conn.status;
			}
			else if(xdrF && !xdrA){
				// Set XDR transaction failure to a status of 0, which
				// resolves as an HTTP failure, instead of an exception.
				httpStatus = 0;
			}
			else{
				httpStatus = 13030;
			}
		}
		catch(e){

			 // 13030 is a custom code to indicate the condition -- in Mozilla/FF --
			 // when the XHR object's status and statusText properties are
			 // unavailable, and a query attempt throws an exception.
			httpStatus = 13030;
		}

		if((httpStatus >= 200 && httpStatus < 300) || httpStatus === 1223 || xdrS){
			responseObject = o.xdr ? o.r : this.createResponseObject(o, args);
			if(callback && callback.success){
				if(!callback.scope){
					callback.success(responseObject);
					YAHOO.log('Success callback. HTTP code is ' + httpStatus, 'info', 'Connection');
				}
				else{
					// If a scope property is defined, the callback will be fired from
					// the context of the object.
					callback.success.apply(callback.scope, [responseObject]);
					YAHOO.log('Success callback with scope. HTTP code is ' + httpStatus, 'info', 'Connection');
				}
			}

			// Fire global custom event -- successEvent
			this.successEvent.fire(responseObject);

			if(o.successEvent){
				// Fire transaction custom event -- successEvent
				o.successEvent.fire(responseObject);
			}
		}
		else{
			switch(httpStatus){
				// The following cases are wininet.dll error codes that may be encountered.
				case 12002: // Server timeout
				case 12029: // 12029 to 12031 correspond to dropped connections.
				case 12030:
				case 12031:
				case 12152: // Connection closed by server.
				case 13030: // See above comments for variable status.
					// XDR transactions will not resolve to this case, since the
					// response object is already built in the xdr response.
					responseObject = this.createExceptionObject(o.tId, args, (isAbort?isAbort:false));
					if(callback && callback.failure){
						if(!callback.scope){
							callback.failure(responseObject);
							YAHOO.log('Failure callback. Exception detected. Status code is ' + httpStatus, 'warn', 'Connection');
						}
						else{
							callback.failure.apply(callback.scope, [responseObject]);
							YAHOO.log('Failure callback with scope. Exception detected. Status code is ' + httpStatus, 'warn', 'Connection');
						}
					}

					break;
				default:
					responseObject = (o.xdr) ? o.response : this.createResponseObject(o, args);
					if(callback && callback.failure){
						if(!callback.scope){
							callback.failure(responseObject);
							YAHOO.log('Failure callback. HTTP status code is ' + httpStatus, 'warn', 'Connection');
						}
						else{
							callback.failure.apply(callback.scope, [responseObject]);
							YAHOO.log('Failure callback with scope. HTTP status code is ' + httpStatus, 'warn', 'Connection');
						}
					}
			}

			// Fire global custom event -- failureEvent
			this.failureEvent.fire(responseObject);

			if(o.failureEvent){
				// Fire transaction custom event -- failureEvent
				o.failureEvent.fire(responseObject);
			}

		}

		this.releaseObject(o);
		responseObject = null;
    },

  /**
   * @description This method evaluates the server response, creates and returns the results via
   * its properties.  Success and failure cases will differ in the response
   * object's property values.
   * @method createResponseObject
   * @private
   * @static
   * @param {object} o The connection object
   * @param {callbackArg} callbackArg The user-defined argument or arguments to be passed to the callback
   * @return {object}
   */
    createResponseObject:function(o, callbackArg)
    {
		var obj = {}, headerObj = {},
			i, headerStr, header, delimitPos;

		try
		{
			headerStr = o.conn.getAllResponseHeaders();
			header = headerStr.split('\n');
			for(i=0; i<header.length; i++){
				delimitPos = header[i].indexOf(':');
				if(delimitPos != -1){
					headerObj[header[i].substring(0,delimitPos)] = YAHOO.lang.trim(header[i].substring(delimitPos+2));
				}
			}
		}
		catch(e){}

		obj.tId = o.tId;
		// Normalize IE's response to HTTP 204 when Win error 1223.
		obj.status = (o.conn.status == 1223)?204:o.conn.status;
		// Normalize IE's statusText to "No Content" instead of "Unknown".
		obj.statusText = (o.conn.status == 1223)?"No Content":o.conn.statusText;
		obj.getResponseHeader = headerObj;
		obj.getAllResponseHeaders = headerStr;
		obj.responseText = o.conn.responseText;
		obj.responseXML = o.conn.responseXML;

		if(callbackArg){
			obj.argument = callbackArg;
		}

		return obj;
    },

  /**
   * @description If a transaction cannot be completed due to dropped or closed connections,
   * there may be not be enough information to build a full response object.
   * The failure callback will be fired and this specific condition can be identified
   * by a status property value of 0.
   *
   * If an abort was successful, the status property will report a value of -1.
   *
   * @method createExceptionObject
   * @private
   * @static
   * @param {int} tId The Transaction Id
   * @param {callbackArg} callbackArg The user-defined argument or arguments to be passed to the callback
   * @param {boolean} isAbort Determines if the exception case is caused by a transaction abort
   * @return {object}
   */
    createExceptionObject:function(tId, callbackArg, isAbort)
    {
		var COMM_CODE = 0,
			COMM_ERROR = 'communication failure',
			ABORT_CODE = -1,
			ABORT_ERROR = 'transaction aborted',
			obj = {};

		obj.tId = tId;
		if(isAbort){
			obj.status = ABORT_CODE;
			obj.statusText = ABORT_ERROR;
		}
		else{
			obj.status = COMM_CODE;
			obj.statusText = COMM_ERROR;
		}

		if(callbackArg){
			obj.argument = callbackArg;
		}

		return obj;
    },

  /**
   * @description Method that initializes the custom HTTP headers for the each transaction.
   * @method initHeader
   * @public
   * @static
   * @param {string} label The HTTP header label
   * @param {string} value The HTTP header value
   * @param {string} isDefault Determines if the specific header is a default header
   * automatically sent with each transaction.
   * @return {void}
   */
	initHeader:function(label, value, isDefault)
	{
		var headerObj = (isDefault)?this._default_headers:this._http_headers;

		headerObj[label] = value;
		if(isDefault){
			this._has_default_headers = true;
		}
		else{
			this._has_http_headers = true;
		}
	},


  /**
   * @description Accessor that sets the HTTP headers for each transaction.
   * @method setHeader
   * @private
   * @static
   * @param {object} o The connection object for the transaction.
   * @return {void}
   */
	setHeader:function(o)
	{
		var prop;
		if(this._has_default_headers){
			for(prop in this._default_headers){
				if(YAHOO.lang.hasOwnProperty(this._default_headers, prop)){
					o.conn.setRequestHeader(prop, this._default_headers[prop]);
					YAHOO.log('Default HTTP header ' + prop + ' set with value of ' + this._default_headers[prop], 'info', 'Connection');
				}
			}
		}

		if(this._has_http_headers){
			for(prop in this._http_headers){
				if(YAHOO.lang.hasOwnProperty(this._http_headers, prop)){
					o.conn.setRequestHeader(prop, this._http_headers[prop]);
					YAHOO.log('HTTP header ' + prop + ' set with value of ' + this._http_headers[prop], 'info', 'Connection');
				}
			}

			this._http_headers = {};
			this._has_http_headers = false;
		}
	},

  /**
   * @description Resets the default HTTP headers object
   * @method resetDefaultHeaders
   * @public
   * @static
   * @return {void}
   */
	resetDefaultHeaders:function(){
		this._default_headers = {};
		this._has_default_headers = false;
	},

  /**
   * @description Method to terminate a transaction, if it has not reached readyState 4.
   * @method abort
   * @public
   * @static
   * @param {object} o The connection object returned by asyncRequest.
   * @param {object} callback  User-defined callback object.
   * @param {string} isTimeout boolean to indicate if abort resulted from a callback timeout.
   * @return {boolean}
   */
	abort:function(o, callback, isTimeout)
	{
		var abortStatus,
			args = (callback && callback.argument)?callback.argument:null;
			o = o || {};

		if(o.conn){
			if(o.xhr){
				if(this.isCallInProgress(o)){
					// Issue abort request
					o.conn.abort();

					window.clearInterval(this._poll[o.tId]);
					delete this._poll[o.tId];

					if(isTimeout){
						window.clearTimeout(this._timeOut[o.tId]);
						delete this._timeOut[o.tId];
					}

					abortStatus = true;
				}
			}
			else if(o.xdr){
				o.conn.abort(o.tId);
				abortStatus = true;
			}
		}
		else if(o.upload){
			var frameId = 'yuiIO' + o.tId;
			var io = document.getElementById(frameId);

			if(io){
				// Remove all listeners on the iframe prior to
				// its destruction.
				YAHOO.util.Event.removeListener(io, "load");
				// Destroy the iframe facilitating the transaction.
				document.body.removeChild(io);
				YAHOO.log('File upload iframe destroyed. Id is:' + frameId, 'info', 'Connection');

				if(isTimeout){
					window.clearTimeout(this._timeOut[o.tId]);
					delete this._timeOut[o.tId];
				}

				abortStatus = true;
			}
		}
		else{
			abortStatus = false;
		}

		if(abortStatus === true){
			// Fire global custom event -- abortEvent
			this.abortEvent.fire(o, args);

			if(o.abortEvent){
				// Fire transaction custom event -- abortEvent
				o.abortEvent.fire(o, args);
			}

			this.handleTransactionResponse(o, callback, true);
			YAHOO.log('Transaction ' + o.tId + ' aborted.', 'info', 'Connection');
		}

		return abortStatus;
	},

  /**
   * @description Determines if the transaction is still being processed.
   * @method isCallInProgress
   * @public
   * @static
   * @param {object} o The connection object returned by asyncRequest
   * @return {boolean}
   */
	isCallInProgress:function(o)
	{
		o = o || {};
		// if the XHR object assigned to the transaction has not been dereferenced,
		// then check its readyState status.  Otherwise, return false.
		if(o.xhr && o.conn){
			return o.conn.readyState !== 4 && o.conn.readyState !== 0;
		}
		else if(o.xdr && o.conn){
			return o.conn.isCallInProgress(o.tId);
		}
		else if(o.upload === true){
			return document.getElementById('yuiIO' + o.tId)?true:false;
		}
		else{
			return false;
		}
	},

  /**
   * @description Dereference the XHR instance and the connection object after the transaction is completed.
   * @method releaseObject
   * @private
   * @static
   * @param {object} o The connection object
   * @return {void}
   */
	releaseObject:function(o)
	{
		if(o && o.conn){
			//dereference the XHR instance.
			o.conn = null;

			YAHOO.log('Connection object for transaction ' + o.tId + ' destroyed.', 'info', 'Connection');

			//dereference the connection object.
			o = null;
		}
	}
};

/**
  * @for Connect
  */
(function() {
	var YCM = YAHOO.util.Connect, _fn = {};

   /**
    * @description This method creates and instantiates the Flash transport.
    * @method _swf
    * @private
    * @static
    * @param {string} URI to connection.swf.
    * @return {void}
    */
	function _swf(uri) {
		var o = '<object id="YUIConnectionSwf" type="application/x-shockwave-flash" data="' +
		        uri + '" width="0" height="0">' +
		     	'<param name="movie" value="' + uri + '">' +
                '<param name="allowScriptAccess" value="always">' +
		    	'</object>',
		    c = document.createElement('div');

		document.body.appendChild(c);
		c.innerHTML = o;
	}

   /**
    * @description This method calls the public method on the
    * Flash transport to start the XDR transaction.  It is analogous
    * to Connection Manager's asyncRequest method.
    * @method xdr
    * @private
    * @static
    * @param {object} The transaction object.
    * @param {string} HTTP request method.
    * @param {string} URI for the transaction.
    * @param {object} The transaction's callback object.
    * @param {object} The JSON object used as HTTP POST data.
    * @return {void}
    */
	function _xdr(o, m, u, c, d) {
		_fn[parseInt(o.tId)] = { 'o':o, 'c':c };
		if (d) {
			c.method = m;
			c.data = d;
		}

		o.conn.send(u, c, o.tId);
	}

   /**
    * @description This method instantiates the Flash transport and
    * establishes a static reference to it, used for all XDR requests.
    * @method transport
    * @public
    * @static
    * @param {string} URI to connection.swf.
    * @return {void}
    */
	function _init(uri) {
		_swf(uri);
		YCM._transport = document.getElementById('YUIConnectionSwf');
	}

	function _xdrReady() {
		YCM.xdrReadyEvent.fire();
	}

   /**
    * @description This method fires the global and transaction start
    * events.
    * @method _xdrStart
    * @private
    * @static
    * @param {object} The transaction object.
    * @param {string} The transaction's callback object.
    * @return {void}
    */
	function _xdrStart(o, cb) {
		if (o) {
			// Fire global custom event -- startEvent
			YCM.startEvent.fire(o, cb.argument);

			if(o.startEvent){
				// Fire transaction custom event -- startEvent
				o.startEvent.fire(o, cb.argument);
			}
		}
	}

   /**
    * @description This method is the initial response handler
    * for XDR transactions.  The Flash transport calls this
    * function and sends the response payload.
    * @method handleXdrResponse
    * @private
    * @static
    * @param {object} The response object sent from the Flash transport.
    * @return {void}
    */
	function _handleXdrResponse(r) {
		var o = _fn[r.tId].o,
			cb = _fn[r.tId].c;

		if (r.statusText === 'xdr:start') {
			_xdrStart(o, cb);
			return;
		}

		r.responseText = decodeURI(r.responseText);
		o.r = r;
		if (cb.argument) {
			o.r.argument = cb.argument;
		}

		this.handleTransactionResponse(o, cb, r.statusText === 'xdr:abort' ? true : false);
		delete _fn[r.tId];
	}

	// Bind the functions to Connection Manager as static fields.
	YCM.xdr = _xdr;
	YCM.swf = _swf;
	YCM.transport = _init;
	YCM.xdrReadyEvent = new YAHOO.util.CustomEvent('xdrReady');
	YCM.xdrReady = _xdrReady;
	YCM.handleXdrResponse = _handleXdrResponse;
})();

/**
  * @for Connect
  */
(function(){
	var YCM = YAHOO.util.Connect,
		YE = YAHOO.util.Event;
   /**
	* @description Property modified by setForm() to determine if the data
	* should be submitted as an HTML form.
	* @property _isFormSubmit
	* @private
	* @static
	* @type boolean
	*/
	YCM._isFormSubmit = false;

   /**
	* @description Property modified by setForm() to determine if a file(s)
	* upload is expected.
	* @property _isFileUpload
	* @private
	* @static
	* @type boolean
	*/
	YCM._isFileUpload = false;

   /**
	* @description Property modified by setForm() to set a reference to the HTML
	* form node if the desired action is file upload.
	* @property _formNode
	* @private
	* @static
	* @type object
	*/
	YCM._formNode = null;

   /**
	* @description Property modified by setForm() to set the HTML form data
	* for each transaction.
	* @property _sFormData
	* @private
	* @static
	* @type string
	*/
	YCM._sFormData = null;

   /**
	* @description Tracks the name-value pair of the "clicked" submit button if multiple submit
	* buttons are present in an HTML form; and, if YAHOO.util.Event is available.
	* @property _submitElementValue
	* @private
	* @static
	* @type string
	*/
	YCM._submitElementValue = null;

   /**
    * @description Custom event that fires when handleTransactionResponse() determines a
    * response in the HTTP 4xx/5xx range.
    * @property failureEvent
    * @private
    * @static
    * @type CustomEvent
    */
	YCM.uploadEvent = new YAHOO.util.CustomEvent('upload'),

   /**
	* @description Determines whether YAHOO.util.Event is available and returns true or false.
	* If true, an event listener is bound at the document level to trap click events that
	* resolve to a target type of "Submit".  This listener will enable setForm() to determine
	* the clicked "Submit" value in a multi-Submit button, HTML form.
	* @property _hasSubmitListener
	* @private
	* @static
	*/
	YCM._hasSubmitListener = function() {
		if(YE){
			YE.addListener(
				document,
				'click',
				function(e){
					var obj = YE.getTarget(e),
						name = obj.nodeName.toLowerCase();

					if((name === 'input' || name === 'button') && (obj.type && obj.type.toLowerCase() == 'submit')){
						YCM._submitElementValue = encodeURIComponent(obj.name) + "=" + encodeURIComponent(obj.value);
					}
				});
			return true;
		}
		return false;
	}();

  /**
   * @description This method assembles the form label and value pairs and
   * constructs an encoded string.
   * asyncRequest() will automatically initialize the transaction with a
   * a HTTP header Content-Type of application/x-www-form-urlencoded.
   * @method setForm
   * @public
   * @static
   * @param {string || object} form id or name attribute, or form object.
   * @param {boolean} optional enable file upload.
   * @param {boolean} optional enable file upload over SSL in IE only.
   * @return {string} string of the HTML form field name and value pairs..
   */
	function _setForm(formId, isUpload, secureUri)
	{
		var oForm, oElement, oName, oValue, oDisabled,
			hasSubmit = false,
			data = [], item = 0,
			i,len,j,jlen,opt;

		this.resetFormState();

		if(typeof formId == 'string'){
			// Determine if the argument is a form id or a form name.
			// Note form name usage is deprecated by supported
			// here for legacy reasons.
			oForm = (document.getElementById(formId) || document.forms[formId]);
		}
		else if(typeof formId == 'object'){
			// Treat argument as an HTML form object.
			oForm = formId;
		}
		else{
			YAHOO.log('Unable to create form object ' + formId, 'warn', 'Connection');
			return;
		}

		// If the isUpload argument is true, setForm will call createFrame to initialize
		// an iframe as the form target.
		//
		// The argument secureURI is also required by IE in SSL environments
		// where the secureURI string is a fully qualified HTTP path, used to set the source
		// of the iframe, to a stub resource in the same domain.
		if(isUpload){

			// Create iframe in preparation for file upload.
			this.createFrame(secureUri?secureUri:null);

			// Set form reference and file upload properties to true.
			this._isFormSubmit = true;
			this._isFileUpload = true;
			this._formNode = oForm;

			return;
		}

		// Iterate over the form elements collection to construct the
		// label-value pairs.
		for (i=0,len=oForm.elements.length; i<len; ++i){
			oElement  = oForm.elements[i];
			oDisabled = oElement.disabled;
			oName     = oElement.name;

			// Do not submit fields that are disabled or
			// do not have a name attribute value.
			if(!oDisabled && oName)
			{
				oName  = encodeURIComponent(oName)+'=';
				oValue = encodeURIComponent(oElement.value);

				switch(oElement.type)
				{
					// Safari, Opera, FF all default opt.value from .text if
					// value attribute not specified in markup
					case 'select-one':
						if (oElement.selectedIndex > -1) {
							opt = oElement.options[oElement.selectedIndex];
							data[item++] = oName + encodeURIComponent(
								(opt.attributes.value && opt.attributes.value.specified) ? opt.value : opt.text);
						}
						break;
					case 'select-multiple':
						if (oElement.selectedIndex > -1) {
							for(j=oElement.selectedIndex, jlen=oElement.options.length; j<jlen; ++j){
								opt = oElement.options[j];
								if (opt.selected) {
									data[item++] = oName + encodeURIComponent(
										(opt.attributes.value && opt.attributes.value.specified) ? opt.value : opt.text);
								}
							}
						}
						break;
					case 'radio':
					case 'checkbox':
						if(oElement.checked){
							data[item++] = oName + oValue;
						}
						break;
					case 'file':
						// stub case as XMLHttpRequest will only send the file path as a string.
					case undefined:
						// stub case for fieldset element which returns undefined.
					case 'reset':
						// stub case for input type reset button.
					case 'button':
						// stub case for input type button elements.
						break;
					case 'submit':
						if(hasSubmit === false){
							if(this._hasSubmitListener && this._submitElementValue){
								data[item++] = this._submitElementValue;
							}
							hasSubmit = true;
						}
						break;
					default:
						data[item++] = oName + oValue;
				}
			}
		}

		this._isFormSubmit = true;
		this._sFormData = data.join('&');

		YAHOO.log('Form initialized for transaction. HTML form POST message is: ' + this._sFormData, 'info', 'Connection');

		this.initHeader('Content-Type', this._default_form_header);
		YAHOO.log('Initialize header Content-Type to application/x-www-form-urlencoded for setForm() transaction.', 'info', 'Connection');

		return this._sFormData;
	}

   /**
    * @description Resets HTML form properties when an HTML form or HTML form
    * with file upload transaction is sent.
    * @method resetFormState
    * @private
    * @static
    * @return {void}
    */
	function _resetFormState(){
		this._isFormSubmit = false;
		this._isFileUpload = false;
		this._formNode = null;
		this._sFormData = "";
	}


   /**
    * @description Creates an iframe to be used for form file uploads.  It is remove from the
    * document upon completion of the upload transaction.
    * @method createFrame
    * @private
    * @static
    * @param {string} optional qualified path of iframe resource for SSL in IE.
    * @return {void}
    */
	function _createFrame(secureUri){

		// IE does not allow the setting of id and name attributes as object
		// properties via createElement().  A different iframe creation
		// pattern is required for IE.
		var frameId = 'yuiIO' + this._transaction_id,
			io;
		if(YAHOO.env.ua.ie){
			io = document.createElement('<iframe id="' + frameId + '" name="' + frameId + '" />');

			// IE will throw a security exception in an SSL environment if the
			// iframe source is undefined.
			if(typeof secureUri == 'boolean'){
				io.src = 'javascript:false';
			}
		}
		else{
			io = document.createElement('iframe');
			io.id = frameId;
			io.name = frameId;
		}

		io.style.position = 'absolute';
		io.style.top = '-1000px';
		io.style.left = '-1000px';

		document.body.appendChild(io);
		YAHOO.log('File upload iframe created. Id is:' + frameId, 'info', 'Connection');
	}

   /**
    * @description Parses the POST data and creates hidden form elements
    * for each key-value, and appends them to the HTML form object.
    * @method appendPostData
    * @private
    * @static
    * @param {string} postData The HTTP POST data
    * @return {array} formElements Collection of hidden fields.
    */
	function _appendPostData(postData){
		var formElements = [],
			postMessage = postData.split('&'),
			i, delimitPos;

		for(i=0; i < postMessage.length; i++){
			delimitPos = postMessage[i].indexOf('=');
			if(delimitPos != -1){
				formElements[i] = document.createElement('input');
				formElements[i].type = 'hidden';
				formElements[i].name = decodeURIComponent(postMessage[i].substring(0,delimitPos));
				formElements[i].value = decodeURIComponent(postMessage[i].substring(delimitPos+1));
				this._formNode.appendChild(formElements[i]);
			}
		}

		return formElements;
	}

   /**
    * @description Uploads HTML form, inclusive of files/attachments, using the
    * iframe created in createFrame to facilitate the transaction.
    * @method uploadFile
    * @private
    * @static
    * @param {int} id The transaction id.
    * @param {object} callback User-defined callback object.
    * @param {string} uri Fully qualified path of resource.
    * @param {string} postData POST data to be submitted in addition to HTML form.
    * @return {void}
    */
	function _uploadFile(o, callback, uri, postData){
		// Each iframe has an id prefix of "yuiIO" followed
		// by the unique transaction id.
		var frameId = 'yuiIO' + o.tId,
		    uploadEncoding = 'multipart/form-data',
		    io = document.getElementById(frameId),
		    ie8 = (document.documentMode && document.documentMode === 8) ? true : false,
		    oConn = this,
			args = (callback && callback.argument)?callback.argument:null,
            oElements,i,prop,obj, rawFormAttributes, uploadCallback;

		// Track original HTML form attribute values.
		rawFormAttributes = {
			action:this._formNode.getAttribute('action'),
			method:this._formNode.getAttribute('method'),
			target:this._formNode.getAttribute('target')
		};

		// Initialize the HTML form properties in case they are
		// not defined in the HTML form.
		this._formNode.setAttribute('action', uri);
		this._formNode.setAttribute('method', 'POST');
		this._formNode.setAttribute('target', frameId);

		if(YAHOO.env.ua.ie && !ie8){
			// IE does not respect property enctype for HTML forms.
			// Instead it uses the property - "encoding".
			this._formNode.setAttribute('encoding', uploadEncoding);
		}
		else{
			this._formNode.setAttribute('enctype', uploadEncoding);
		}

		if(postData){
			oElements = this.appendPostData(postData);
		}

		// Start file upload.
		this._formNode.submit();

		// Fire global custom event -- startEvent
		this.startEvent.fire(o, args);

		if(o.startEvent){
			// Fire transaction custom event -- startEvent
			o.startEvent.fire(o, args);
		}

		// Start polling if a callback is present and the timeout
		// property has been defined.
		if(callback && callback.timeout){
			this._timeOut[o.tId] = window.setTimeout(function(){ oConn.abort(o, callback, true); }, callback.timeout);
		}

		// Remove HTML elements created by appendPostData
		if(oElements && oElements.length > 0){
			for(i=0; i < oElements.length; i++){
				this._formNode.removeChild(oElements[i]);
			}
		}

		// Restore HTML form attributes to their original
		// values prior to file upload.
		for(prop in rawFormAttributes){
			if(YAHOO.lang.hasOwnProperty(rawFormAttributes, prop)){
				if(rawFormAttributes[prop]){
					this._formNode.setAttribute(prop, rawFormAttributes[prop]);
				}
				else{
					this._formNode.removeAttribute(prop);
				}
			}
		}

		// Reset HTML form state properties.
		this.resetFormState();

		// Create the upload callback handler that fires when the iframe
		// receives the load event.  Subsequently, the event handler is detached
		// and the iframe removed from the document.
		uploadCallback = function() {
			if(callback && callback.timeout){
				window.clearTimeout(oConn._timeOut[o.tId]);
				delete oConn._timeOut[o.tId];
			}

			// Fire global custom event -- completeEvent
			oConn.completeEvent.fire(o, args);

			if(o.completeEvent){
				// Fire transaction custom event -- completeEvent
				o.completeEvent.fire(o, args);
			}

			obj = {
			    tId : o.tId,
			    argument : callback.argument
            };

			try
			{
				// responseText and responseXML will be populated with the same data from the iframe.
				// Since the HTTP headers cannot be read from the iframe
				obj.responseText = io.contentWindow.document.body?io.contentWindow.document.body.innerHTML:io.contentWindow.document.documentElement.textContent;
				obj.responseXML = io.contentWindow.document.XMLDocument?io.contentWindow.document.XMLDocument:io.contentWindow.document;
			}
			catch(e){}

			if(callback && callback.upload){
				if(!callback.scope){
					callback.upload(obj);
					YAHOO.log('Upload callback.', 'info', 'Connection');
				}
				else{
					callback.upload.apply(callback.scope, [obj]);
					YAHOO.log('Upload callback with scope.', 'info', 'Connection');
				}
			}

			// Fire global custom event -- uploadEvent
			oConn.uploadEvent.fire(obj);

			if(o.uploadEvent){
				// Fire transaction custom event -- uploadEvent
				o.uploadEvent.fire(obj);
			}

			YE.removeListener(io, "load", uploadCallback);

			setTimeout(
				function(){
					document.body.removeChild(io);
					oConn.releaseObject(o);
					YAHOO.log('File upload iframe destroyed. Id is:' + frameId, 'info', 'Connection');
				}, 100);
		};

		// Bind the onload handler to the iframe to detect the file upload response.
		YE.addListener(io, "load", uploadCallback);
	}

	YCM.setForm = _setForm;
	YCM.resetFormState = _resetFormState;
	YCM.createFrame = _createFrame;
	YCM.appendPostData = _appendPostData;
	YCM.uploadFile = _uploadFile;
})();

YAHOO.register("connection", YAHOO.util.Connect, {version: "2.8.1", build: "19"});
/*
Copyright (c) 2010, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.com/yui/license.html
version: 2.8.1
*/
/****************************************************************************/
/****************************************************************************/
/****************************************************************************/

/**
 * The LogMsg class defines a single log message.
 *
 * @class LogMsg
 * @constructor
 * @param oConfigs {Object} Object literal of configuration params.
 */
YAHOO.widget.LogMsg = function(oConfigs) {
    // Parse configs
    /**
     * Log message.
     *
     * @property msg
     * @type String
     */
    this.msg =
    /**
     * Log timestamp.
     *
     * @property time
     * @type Date
     */
    this.time =

    /**
     * Log category.
     *
     * @property category
     * @type String
     */
    this.category =

    /**
     * Log source. The first word passed in as the source argument.
     *
     * @property source
     * @type String
     */
    this.source =

    /**
     * Log source detail. The remainder of the string passed in as the source argument, not
     * including the first word (if any).
     *
     * @property sourceDetail
     * @type String
     */
    this.sourceDetail = null;

    if (oConfigs && (oConfigs.constructor == Object)) {
        for(var param in oConfigs) {
            if (oConfigs.hasOwnProperty(param)) {
                this[param] = oConfigs[param];
            }
        }
    }
};
/****************************************************************************/
/****************************************************************************/
/****************************************************************************/

/**
 * The LogWriter class provides a mechanism to log messages through
 * YAHOO.widget.Logger from a named source.
 *
 * @class LogWriter
 * @constructor
 * @param sSource {String} Source of LogWriter instance.
 */
YAHOO.widget.LogWriter = function(sSource) {
    if(!sSource) {
        YAHOO.log("Could not instantiate LogWriter due to invalid source.",
            "error", "LogWriter");
        return;
    }
    this._source = sSource;
 };

/////////////////////////////////////////////////////////////////////////////
//
// Public methods
//
/////////////////////////////////////////////////////////////////////////////

 /**
 * Public accessor to the unique name of the LogWriter instance.
 *
 * @method toString
 * @return {String} Unique name of the LogWriter instance.
 */
YAHOO.widget.LogWriter.prototype.toString = function() {
    return "LogWriter " + this._sSource;
};

/**
 * Logs a message attached to the source of the LogWriter.
 *
 * @method log
 * @param sMsg {String} The log message.
 * @param sCategory {String} Category name.
 */
YAHOO.widget.LogWriter.prototype.log = function(sMsg, sCategory) {
    YAHOO.widget.Logger.log(sMsg, sCategory, this._source);
};

/**
 * Public accessor to get the source name.
 *
 * @method getSource
 * @return {String} The LogWriter source.
 */
YAHOO.widget.LogWriter.prototype.getSource = function() {
    return this._source;
};

/**
 * Public accessor to set the source name.
 *
 * @method setSource
 * @param sSource {String} Source of LogWriter instance.
 */
YAHOO.widget.LogWriter.prototype.setSource = function(sSource) {
    if(!sSource) {
        YAHOO.log("Could not set source due to invalid source.", "error", this.toString());
        return;
    }
    else {
        this._source = sSource;
    }
};

/////////////////////////////////////////////////////////////////////////////
//
// Private member variables
//
/////////////////////////////////////////////////////////////////////////////

/**
 * Source of the LogWriter instance.
 *
 * @property _source
 * @type String
 * @private
 */
YAHOO.widget.LogWriter.prototype._source = null;



 /**
 * The Logger widget provides a simple way to read or write log messages in
 * JavaScript code. Integration with the YUI Library's debug builds allow
 * implementers to access under-the-hood events, errors, and debugging messages.
 * Output may be read through a LogReader console and/or output to a browser
 * console.
 *
 * @module logger
 * @requires yahoo, event, dom
 * @optional dragdrop
 * @namespace YAHOO.widget
 * @title Logger Widget
 */

/****************************************************************************/
/****************************************************************************/
/****************************************************************************/

// Define once
if(!YAHOO.widget.Logger) {
    /**
     * The singleton Logger class provides core log management functionality. Saves
     * logs written through the global YAHOO.log function or written by a LogWriter
     * instance. Provides access to logs for reading by a LogReader instance or
     * native browser console such as the Firebug extension to Firefox or Safari's
     * JavaScript console through integration with the console.log() method.
     *
     * @class Logger
     * @static
     */
    YAHOO.widget.Logger = {
        // Initialize properties
        loggerEnabled: true,
        _browserConsoleEnabled: false,
        categories: ["info","warn","error","time","window"],
        sources: ["global"],
        _stack: [], // holds all log msgs
        maxStackEntries: 2500,
        _startTime: new Date().getTime(), // static start timestamp
        _lastTime: null, // timestamp of last logged message
        _windowErrorsHandled: false,
        _origOnWindowError: null
    };

    /////////////////////////////////////////////////////////////////////////////
    //
    // Public properties
    //
    /////////////////////////////////////////////////////////////////////////////
    /**
     * True if Logger is enabled, false otherwise.
     *
     * @property loggerEnabled
     * @type Boolean
     * @static
     * @default true
     */

    /**
     * Array of categories.
     *
     * @property categories
     * @type String[]
     * @static
     * @default ["info","warn","error","time","window"]
     */

    /**
     * Array of sources.
     *
     * @property sources
     * @type String[]
     * @static
     * @default ["global"]
     */

    /**
     * Upper limit on size of internal stack.
     *
     * @property maxStackEntries
     * @type Number
     * @static
     * @default 2500
     */

    /////////////////////////////////////////////////////////////////////////////
    //
    // Private properties
    //
    /////////////////////////////////////////////////////////////////////////////
    /**
     * Internal property to track whether output to browser console is enabled.
     *
     * @property _browserConsoleEnabled
     * @type Boolean
     * @static
     * @default false
     * @private
     */

    /**
     * Array to hold all log messages.
     *
     * @property _stack
     * @type Array
     * @static
     * @private
     */
    /**
     * Static timestamp of Logger initialization.
     *
     * @property _startTime
     * @type Date
     * @static
     * @private
     */
    /**
     * Timestamp of last logged message.
     *
     * @property _lastTime
     * @type Date
     * @static
     * @private
     */
    /////////////////////////////////////////////////////////////////////////////
    //
    // Public methods
    //
    /////////////////////////////////////////////////////////////////////////////
    /**
     * Saves a log message to the stack and fires newLogEvent. If the log message is
     * assigned to an unknown category, creates a new category. If the log message is
     * from an unknown source, creates a new source.  If browser console is enabled,
     * outputs the log message to browser console.
     *
     * @method log
     * @param sMsg {String} The log message.
     * @param sCategory {String} Category of log message, or null.
     * @param sSource {String} Source of LogWriter, or null if global.
     */
    YAHOO.widget.Logger.log = function(sMsg, sCategory, sSource) {
        if(this.loggerEnabled) {
            if(!sCategory) {
                sCategory = "info"; // default category
            }
            else {
                sCategory = sCategory.toLocaleLowerCase();
                if(this._isNewCategory(sCategory)) {
                    this._createNewCategory(sCategory);
                }
            }
            var sClass = "global"; // default source
            var sDetail = null;
            if(sSource) {
                var spaceIndex = sSource.indexOf(" ");
                if(spaceIndex > 0) {
                    // Substring until first space
                    sClass = sSource.substring(0,spaceIndex);
                    // The rest of the source
                    sDetail = sSource.substring(spaceIndex,sSource.length);
                }
                else {
                    sClass = sSource;
                }
                if(this._isNewSource(sClass)) {
                    this._createNewSource(sClass);
                }
            }

            var timestamp = new Date();
            var logEntry = new YAHOO.widget.LogMsg({
                msg: sMsg,
                time: timestamp,
                category: sCategory,
                source: sClass,
                sourceDetail: sDetail
            });

            var stack = this._stack;
            var maxStackEntries = this.maxStackEntries;
            if(maxStackEntries && !isNaN(maxStackEntries) &&
                (stack.length >= maxStackEntries)) {
                stack.shift();
            }
            stack.push(logEntry);
            this.newLogEvent.fire(logEntry);

            if(this._browserConsoleEnabled) {
                this._printToBrowserConsole(logEntry);
            }
            return true;
        }
        else {
            return false;
        }
    };

    /**
     * Resets internal stack and startTime, enables Logger, and fires logResetEvent.
     *
     * @method reset
     */
    YAHOO.widget.Logger.reset = function() {
        this._stack = [];
        this._startTime = new Date().getTime();
        this.loggerEnabled = true;
        this.log("Logger reset");
        this.logResetEvent.fire();
    };

    /**
     * Public accessor to internal stack of log message objects.
     *
     * @method getStack
     * @return {Object[]} Array of log message objects.
     */
    YAHOO.widget.Logger.getStack = function() {
        return this._stack;
    };

    /**
     * Public accessor to internal start time.
     *
     * @method getStartTime
     * @return {Date} Internal date of when Logger singleton was initialized.
     */
    YAHOO.widget.Logger.getStartTime = function() {
        return this._startTime;
    };

    /**
     * Disables output to the browser's global console.log() function, which is used
     * by the Firebug extension to Firefox as well as Safari.
     *
     * @method disableBrowserConsole
     */
    YAHOO.widget.Logger.disableBrowserConsole = function() {
        YAHOO.log("Logger output to the function console.log() has been disabled.");
        this._browserConsoleEnabled = false;
    };

    /**
     * Enables output to the browser's global console.log() function, which is used
     * by the Firebug extension to Firefox as well as Safari.
     *
     * @method enableBrowserConsole
     */
    YAHOO.widget.Logger.enableBrowserConsole = function() {
        this._browserConsoleEnabled = true;
        YAHOO.log("Logger output to the function console.log() has been enabled.");
    };

    /**
     * Surpresses native JavaScript errors and outputs to console. By default,
     * Logger does not handle JavaScript window error events.
     * NB: Not all browsers support the window.onerror event.
     *
     * @method handleWindowErrors
     */
    YAHOO.widget.Logger.handleWindowErrors = function() {
        if(!YAHOO.widget.Logger._windowErrorsHandled) {
            // Save any previously defined handler to call
            if(window.error) {
                YAHOO.widget.Logger._origOnWindowError = window.onerror;
            }
            window.onerror = YAHOO.widget.Logger._onWindowError;
            YAHOO.widget.Logger._windowErrorsHandled = true;
            YAHOO.log("Logger handling of window.onerror has been enabled.");
        }
        else {
            YAHOO.log("Logger handling of window.onerror had already been enabled.");
        }
    };

    /**
     * Unsurpresses native JavaScript errors. By default,
     * Logger does not handle JavaScript window error events.
     * NB: Not all browsers support the window.onerror event.
     *
     * @method unhandleWindowErrors
     */
    YAHOO.widget.Logger.unhandleWindowErrors = function() {
        if(YAHOO.widget.Logger._windowErrorsHandled) {
            // Revert to any previously defined handler to call
            if(YAHOO.widget.Logger._origOnWindowError) {
                window.onerror = YAHOO.widget.Logger._origOnWindowError;
                YAHOO.widget.Logger._origOnWindowError = null;
            }
            else {
                window.onerror = null;
            }
            YAHOO.widget.Logger._windowErrorsHandled = false;
            YAHOO.log("Logger handling of window.onerror has been disabled.");
        }
        else {
            YAHOO.log("Logger handling of window.onerror had already been disabled.");
        }
    };
    
    /////////////////////////////////////////////////////////////////////////////
    //
    // Public events
    //
    /////////////////////////////////////////////////////////////////////////////

     /**
     * Fired when a new category has been created.
     *
     * @event categoryCreateEvent
     * @param sCategory {String} Category name.
     */
    YAHOO.widget.Logger.categoryCreateEvent =
        new YAHOO.util.CustomEvent("categoryCreate", this, true);

     /**
     * Fired when a new source has been named.
     *
     * @event sourceCreateEvent
     * @param sSource {String} Source name.
     */
    YAHOO.widget.Logger.sourceCreateEvent =
        new YAHOO.util.CustomEvent("sourceCreate", this, true);

     /**
     * Fired when a new log message has been created.
     *
     * @event newLogEvent
     * @param sMsg {String} Log message.
     */
    YAHOO.widget.Logger.newLogEvent = new YAHOO.util.CustomEvent("newLog", this, true);

    /**
     * Fired when the Logger has been reset has been created.
     *
     * @event logResetEvent
     */
    YAHOO.widget.Logger.logResetEvent = new YAHOO.util.CustomEvent("logReset", this, true);

    /////////////////////////////////////////////////////////////////////////////
    //
    // Private methods
    //
    /////////////////////////////////////////////////////////////////////////////

    /**
     * Creates a new category of log messages and fires categoryCreateEvent.
     *
     * @method _createNewCategory
     * @param sCategory {String} Category name.
     * @private
     */
    YAHOO.widget.Logger._createNewCategory = function(sCategory) {
        this.categories.push(sCategory);
        this.categoryCreateEvent.fire(sCategory);
    };

    /**
     * Checks to see if a category has already been created.
     *
     * @method _isNewCategory
     * @param sCategory {String} Category name.
     * @return {Boolean} Returns true if category is unknown, else returns false.
     * @private
     */
    YAHOO.widget.Logger._isNewCategory = function(sCategory) {
        for(var i=0; i < this.categories.length; i++) {
            if(sCategory == this.categories[i]) {
                return false;
            }
        }
        return true;
    };

    /**
     * Creates a new source of log messages and fires sourceCreateEvent.
     *
     * @method _createNewSource
     * @param sSource {String} Source name.
     * @private
     */
    YAHOO.widget.Logger._createNewSource = function(sSource) {
        this.sources.push(sSource);
        this.sourceCreateEvent.fire(sSource);
    };

    /**
     * Checks to see if a source already exists.
     *
     * @method _isNewSource
     * @param sSource {String} Source name.
     * @return {Boolean} Returns true if source is unknown, else returns false.
     * @private
     */
    YAHOO.widget.Logger._isNewSource = function(sSource) {
        if(sSource) {
            for(var i=0; i < this.sources.length; i++) {
                if(sSource == this.sources[i]) {
                    return false;
                }
            }
            return true;
        }
    };

    /**
     * Outputs a log message to global console.log() function.
     *
     * @method _printToBrowserConsole
     * @param oEntry {Object} Log entry object.
     * @private
     */
    YAHOO.widget.Logger._printToBrowserConsole = function(oEntry) {
        if(window.console && console.log) {
            var category = oEntry.category;
            var label = oEntry.category.substring(0,4).toUpperCase();

            var time = oEntry.time;
            var localTime;
            if (time.toLocaleTimeString) {
                localTime  = time.toLocaleTimeString();
            }
            else {
                localTime = time.toString();
            }

            var msecs = time.getTime();
            var elapsedTime = (YAHOO.widget.Logger._lastTime) ?
                (msecs - YAHOO.widget.Logger._lastTime) : 0;
            YAHOO.widget.Logger._lastTime = msecs;

            var output =
                localTime + " (" +
                elapsedTime + "ms): " +
                oEntry.source + ": ";

            // for bug 1987607
            if (YAHOO.env.ua.webkit) {
                output += oEntry.msg;
            }

            console.log(output, oEntry.msg);
        }
    };

    /////////////////////////////////////////////////////////////////////////////
    //
    // Private event handlers
    //
    /////////////////////////////////////////////////////////////////////////////

    /**
     * Handles logging of messages due to window error events.
     *
     * @method _onWindowError
     * @param sMsg {String} The error message.
     * @param sUrl {String} URL of the error.
     * @param sLine {String} Line number of the error.
     * @private
     */
    YAHOO.widget.Logger._onWindowError = function(sMsg,sUrl,sLine) {
        // Logger is not in scope of this event handler
        try {
            YAHOO.widget.Logger.log(sMsg+' ('+sUrl+', line '+sLine+')', "window");
            if(YAHOO.widget.Logger._origOnWindowError) {
                YAHOO.widget.Logger._origOnWindowError();
            }
        }
        catch(e) {
            return false;
        }
    };

    /////////////////////////////////////////////////////////////////////////////
    //
    // First log
    //
    /////////////////////////////////////////////////////////////////////////////

    YAHOO.widget.Logger.log("Logger initialized");
}

/****************************************************************************/
/****************************************************************************/
/****************************************************************************/
(function () {
var Logger = YAHOO.widget.Logger,
    u      = YAHOO.util,
    Dom    = u.Dom,
    Event  = u.Event,
    d      = document;

function make(el,props) {
    el = d.createElement(el);
    if (props) {
        for (var p in props) {
            if (props.hasOwnProperty(p)) {
                el[p] = props[p];
            }
        }
    }
    return el;
}

/**
 * The LogReader class provides UI to read messages logged to YAHOO.widget.Logger.
 *
 * @class LogReader
 * @constructor
 * @param elContainer {HTMLElement} (optional) DOM element reference of an existing DIV.
 * @param elContainer {String} (optional) String ID of an existing DIV.
 * @param oConfigs {Object} (optional) Object literal of configuration params.
 */
function LogReader(elContainer, oConfigs) {
    this._sName = LogReader._index;
    LogReader._index++;
    
    this._init.apply(this,arguments);

    /**
     * Render the LogReader immediately upon instantiation.  If set to false,
     * you must call myLogReader.render() to generate the UI.
     * 
     * @property autoRender
     * @type {Boolean}
     * @default true
     */
    if (this.autoRender !== false) {
        this.render();
    }
}

/////////////////////////////////////////////////////////////////////////////
//
// Static member variables
//
/////////////////////////////////////////////////////////////////////////////
YAHOO.lang.augmentObject(LogReader, {
    /**
     * Internal class member to index multiple LogReader instances.
     *
     * @property _memberName
     * @static
     * @type Number
     * @default 0
     * @private
     */
    _index : 0,

    /**
     * Node template for the log entries
     * @property ENTRY_TEMPLATE
     * @static
     * @type {HTMLElement}
     * @default <code>pre</code> element with class yui-log-entry
     */
    ENTRY_TEMPLATE : (function () {
        return make('pre',{ className: 'yui-log-entry' });
    })(),

    /**
     * Template used for innerHTML of verbose entry output.
     * @property VERBOSE_TEMPLATE
     * @static
     * @default "&lt;p>&lt;span class='{category}'>{label}&lt;/span>{totalTime}ms (+{elapsedTime}) {localTime}:&lt;/p>&lt;p>{sourceAndDetail}&lt;/p>&lt;p>{message}&lt;/p>"
     */
    VERBOSE_TEMPLATE : "<p><span class='{category}'>{label}</span> {totalTime}ms (+{elapsedTime}) {localTime}:</p><p>{sourceAndDetail}</p><p>{message}</p>",

    /**
     * Template used for innerHTML of compact entry output.
     * @property BASIC_TEMPLATE
     * @static
     * @default "&lt;p>&lt;span class='{category}'>{label}&lt;/span>{totalTime}ms (+{elapsedTime}) {localTime}: {sourceAndDetail}: {message}&lt;/p>"
     */
    BASIC_TEMPLATE : "<p><span class='{category}'>{label}</span> {totalTime}ms (+{elapsedTime}) {localTime}: {sourceAndDetail}: {message}</p>"
});

/////////////////////////////////////////////////////////////////////////////
//
// Public member variables
//
/////////////////////////////////////////////////////////////////////////////

LogReader.prototype = {
    /**
     * Whether or not LogReader is enabled to output log messages.
     *
     * @property logReaderEnabled
     * @type Boolean
     * @default true
     */
    logReaderEnabled : true,

    /**
     * Public member to access CSS width of the LogReader container.
     *
     * @property width
     * @type String
     */
    width : null,

    /**
     * Public member to access CSS height of the LogReader container.
     *
     * @property height
     * @type String
     */
    height : null,

    /**
     * Public member to access CSS top position of the LogReader container.
     *
     * @property top
     * @type String
     */
    top : null,

    /**
     * Public member to access CSS left position of the LogReader container.
     *
     * @property left
     * @type String
     */
    left : null,

    /**
     * Public member to access CSS right position of the LogReader container.
     *
     * @property right
     * @type String
     */
    right : null,

    /**
     * Public member to access CSS bottom position of the LogReader container.
     *
     * @property bottom
     * @type String
     */
    bottom : null,

    /**
     * Public member to access CSS font size of the LogReader container.
     *
     * @property fontSize
     * @type String
     */
    fontSize : null,

    /**
     * Whether or not the footer UI is enabled for the LogReader.
     *
     * @property footerEnabled
     * @type Boolean
     * @default true
     */
    footerEnabled : true,

    /**
     * Whether or not output is verbose (more readable). Setting to true will make
     * output more compact (less readable).
     *
     * @property verboseOutput
     * @type Boolean
     * @default true
     */
    verboseOutput : true,

    /**
     * Custom output format for log messages.  Defaults to null, which falls
     * back to verboseOutput param deciding between LogReader.VERBOSE_TEMPLATE
     * and LogReader.BASIC_TEMPLATE.  Use bracketed place holders to mark where
     * message info should go.  Available place holder names include:
     * <ul>
     *  <li>category</li>
     *  <li>label</li>
     *  <li>sourceAndDetail</li>
     *  <li>message</li>
     *  <li>localTime</li>
     *  <li>elapsedTime</li>
     *  <li>totalTime</li>
     * </ul>
     *
     * @property entryFormat
     * @type String
     * @default null
     */
    entryFormat : null,

    /**
     * Whether or not newest message is printed on top.
     *
     * @property newestOnTop
     * @type Boolean
     */
    newestOnTop : true,

    /**
     * Output timeout buffer in milliseconds.
     *
     * @property outputBuffer
     * @type Number
     * @default 100
     */
    outputBuffer : 100,

    /**
     * Maximum number of messages a LogReader console will display.
     *
     * @property thresholdMax
     * @type Number
     * @default 500
     */
    thresholdMax : 500,

    /**
     * When a LogReader console reaches its thresholdMax, it will clear out messages
     * and print out the latest thresholdMin number of messages.
     *
     * @property thresholdMin
     * @type Number
     * @default 100
     */
    thresholdMin : 100,

    /**
     * True when LogReader is in a collapsed state, false otherwise.
     *
     * @property isCollapsed
     * @type Boolean
     * @default false
     */
    isCollapsed : false,

    /**
     * True when LogReader is in a paused state, false otherwise.
     *
     * @property isPaused
     * @type Boolean
     * @default false
     */
    isPaused : false,

    /**
     * Enables draggable LogReader if DragDrop Utility is present.
     *
     * @property draggable
     * @type Boolean
     * @default true
     */
    draggable : true,

    /////////////////////////////////////////////////////////////////////////////
    //
    // Public methods
    //
    /////////////////////////////////////////////////////////////////////////////

     /**
     * Public accessor to the unique name of the LogReader instance.
     *
     * @method toString
     * @return {String} Unique name of the LogReader instance.
     */
    toString : function() {
        return "LogReader instance" + this._sName;
    },
    /**
     * Pauses output of log messages. While paused, log messages are not lost, but
     * get saved to a buffer and then output upon resume of LogReader.
     *
     * @method pause
     */
    pause : function() {
        this.isPaused = true;
        this._timeout = null;
        this.logReaderEnabled = false;
        if (this._btnPause) {
            this._btnPause.value = "Resume";
        }
    },

    /**
     * Resumes output of log messages, including outputting any log messages that
     * have been saved to buffer while paused.
     *
     * @method resume
     */
    resume : function() {
        this.isPaused = false;
        this.logReaderEnabled = true;
        this._printBuffer();
        if (this._btnPause) {
            this._btnPause.value = "Pause";
        }
    },

    /**
     * Adds the UI to the DOM, attaches event listeners, and bootstraps initial
     * UI state.
     *
     * @method render
     */
    render : function () {
        if (this.rendered) {
            return;
        }

        this._initContainerEl();
        
        this._initHeaderEl();
        this._initConsoleEl();
        this._initFooterEl();

        this._initCategories();
        this._initSources();

        this._initDragDrop();

        // Subscribe to Logger custom events
        Logger.newLogEvent.subscribe(this._onNewLog, this);
        Logger.logResetEvent.subscribe(this._onReset, this);

        Logger.categoryCreateEvent.subscribe(this._onCategoryCreate, this);
        Logger.sourceCreateEvent.subscribe(this._onSourceCreate, this);

        this.rendered = true;

        this._filterLogs();
    },

    /**
     * Removes the UI from the DOM entirely and detaches all event listeners.
     * Implementers should note that Logger will still accumulate messages.
     *
     * @method destroy
     */
    destroy : function () {
        Event.purgeElement(this._elContainer,true);
        this._elContainer.innerHTML = '';
        this._elContainer.parentNode.removeChild(this._elContainer);

        this.rendered = false;
    },

    /**
     * Hides UI of LogReader. Logging functionality is not disrupted.
     *
     * @method hide
     */
    hide : function() {
        this._elContainer.style.display = "none";
    },

    /**
     * Shows UI of LogReader. Logging functionality is not disrupted.
     *
     * @method show
     */
    show : function() {
        this._elContainer.style.display = "block";
    },

    /**
     * Collapses UI of LogReader. Logging functionality is not disrupted.
     *
     * @method collapse
     */
    collapse : function() {
        this._elConsole.style.display = "none";
        if(this._elFt) {
            this._elFt.style.display = "none";
        }
        this._btnCollapse.value = "Expand";
        this.isCollapsed = true;
    },

    /**
     * Expands UI of LogReader. Logging functionality is not disrupted.
     *
     * @method expand
     */
    expand : function() {
        this._elConsole.style.display = "block";
        if(this._elFt) {
            this._elFt.style.display = "block";
        }
        this._btnCollapse.value = "Collapse";
        this.isCollapsed = false;
    },

    /**
     * Returns related checkbox element for given filter (i.e., category or source).
     *
     * @method getCheckbox
     * @param {String} Category or source name.
     * @return {Array} Array of all filter checkboxes.
     */
    getCheckbox : function(filter) {
        return this._filterCheckboxes[filter];
    },

    /**
     * Returns array of enabled categories.
     *
     * @method getCategories
     * @return {String[]} Array of enabled categories.
     */
    getCategories : function() {
        return this._categoryFilters;
    },

    /**
     * Shows log messages associated with given category.
     *
     * @method showCategory
     * @param {String} Category name.
     */
    showCategory : function(sCategory) {
        var filtersArray = this._categoryFilters;
        // Don't do anything if category is already enabled
        // Use Array.indexOf if available...
        if(filtersArray.indexOf) {
             if(filtersArray.indexOf(sCategory) >  -1) {
                return;
            }
        }
        // ...or do it the old-fashioned way
        else {
            for(var i=0; i<filtersArray.length; i++) {
               if(filtersArray[i] === sCategory){
                    return;
                }
            }
        }

        this._categoryFilters.push(sCategory);
        this._filterLogs();
        var elCheckbox = this.getCheckbox(sCategory);
        if(elCheckbox) {
            elCheckbox.checked = true;
        }
    },

    /**
     * Hides log messages associated with given category.
     *
     * @method hideCategory
     * @param {String} Category name.
     */
    hideCategory : function(sCategory) {
        var filtersArray = this._categoryFilters;
        for(var i=0; i<filtersArray.length; i++) {
            if(sCategory == filtersArray[i]) {
                filtersArray.splice(i, 1);
                break;
            }
        }
        this._filterLogs();
        var elCheckbox = this.getCheckbox(sCategory);
        if(elCheckbox) {
            elCheckbox.checked = false;
        }
    },

    /**
     * Returns array of enabled sources.
     *
     * @method getSources
     * @return {Array} Array of enabled sources.
     */
    getSources : function() {
        return this._sourceFilters;
    },

    /**
     * Shows log messages associated with given source.
     *
     * @method showSource
     * @param {String} Source name.
     */
    showSource : function(sSource) {
        var filtersArray = this._sourceFilters;
        // Don't do anything if category is already enabled
        // Use Array.indexOf if available...
        if(filtersArray.indexOf) {
             if(filtersArray.indexOf(sSource) >  -1) {
                return;
            }
        }
        // ...or do it the old-fashioned way
        else {
            for(var i=0; i<filtersArray.length; i++) {
               if(sSource == filtersArray[i]){
                    return;
                }
            }
        }
        filtersArray.push(sSource);
        this._filterLogs();
        var elCheckbox = this.getCheckbox(sSource);
        if(elCheckbox) {
            elCheckbox.checked = true;
        }
    },

    /**
     * Hides log messages associated with given source.
     *
     * @method hideSource
     * @param {String} Source name.
     */
    hideSource : function(sSource) {
        var filtersArray = this._sourceFilters;
        for(var i=0; i<filtersArray.length; i++) {
            if(sSource == filtersArray[i]) {
                filtersArray.splice(i, 1);
                break;
            }
        }
        this._filterLogs();
        var elCheckbox = this.getCheckbox(sSource);
        if(elCheckbox) {
            elCheckbox.checked = false;
        }
    },

    /**
     * Does not delete any log messages, but clears all printed log messages from
     * the console. Log messages will be printed out again if user re-filters. The
     * static method YAHOO.widget.Logger.reset() should be called in order to
     * actually delete log messages.
     *
     * @method clearConsole
     */
    clearConsole : function() {
        // Clear the buffer of any pending messages
        this._timeout = null;
        this._buffer = [];
        this._consoleMsgCount = 0;

        var elConsole = this._elConsole;
        elConsole.innerHTML = '';
    },

    /**
     * Updates title to given string.
     *
     * @method setTitle
     * @param sTitle {String} New title.
     */
    setTitle : function(sTitle) {
        this._title.innerHTML = this.html2Text(sTitle);
    },

    /**
     * Gets timestamp of the last log.
     *
     * @method getLastTime
     * @return {Date} Timestamp of the last log.
     */
    getLastTime : function() {
        return this._lastTime;
    },

    formatMsg : function (entry) {
        var entryFormat = this.entryFormat || (this.verboseOutput ?
                          LogReader.VERBOSE_TEMPLATE : LogReader.BASIC_TEMPLATE),
            info        = {
                category : entry.category,

                // Label for color-coded display
                label : entry.category.substring(0,4).toUpperCase(),

                sourceAndDetail : entry.sourceDetail ?
                                  entry.source + " " + entry.sourceDetail :
                                  entry.source,

                // Escape HTML entities in the log message itself for output
                // to console
                message : this.html2Text(entry.msg || entry.message || '')
            };

        // Add time info
        if (entry.time && entry.time.getTime) {
            info.localTime = entry.time.toLocaleTimeString ?
                             entry.time.toLocaleTimeString() :
                             entry.time.toString();

            // Calculate the elapsed time to be from the last item that
            // passed through the filter, not the absolute previous item
            // in the stack
            info.elapsedTime = entry.time.getTime() - this.getLastTime();

            info.totalTime = entry.time.getTime() - Logger.getStartTime();
        }

        var msg = LogReader.ENTRY_TEMPLATE.cloneNode(true);
        if (this.verboseOutput) {
            msg.className += ' yui-log-verbose';
        }

        // Bug 2061169: Workaround for YAHOO.lang.substitute()
        msg.innerHTML = entryFormat.replace(/\{(\w+)\}/g,
            function (x, placeholder) {
                return (placeholder in info) ? info[placeholder] : '';
            });

        return msg;
    },

    /**
     * Converts input chars "<", ">", and "&" to HTML entities.
     *
     * @method html2Text
     * @param sHtml {String} String to convert.
     * @private
     */
    html2Text : function(sHtml) {
        if(sHtml) {
            sHtml += "";
            return sHtml.replace(/&/g, "&#38;").
                         replace(/</g, "&#60;").
                         replace(/>/g, "&#62;");
        }
        return "";
    },

/////////////////////////////////////////////////////////////////////////////
//
// Private member variables
//
/////////////////////////////////////////////////////////////////////////////

    /**
     * Name of LogReader instance.
     *
     * @property _sName
     * @type String
     * @private
     */
    _sName : null,

    //TODO: remove
    /**
     * A class member shared by all LogReaders if a container needs to be
     * created during instantiation. Will be null if a container element never needs to
     * be created on the fly, such as when the implementer passes in their own element.
     *
     * @property _elDefaultContainer
     * @type HTMLElement
     * @private
     */
    //YAHOO.widget.LogReader._elDefaultContainer = null;

    /**
     * Buffer of log message objects for batch output.
     *
     * @property _buffer
     * @type Object[]
     * @private
     */
    _buffer : null,

    /**
     * Number of log messages output to console.
     *
     * @property _consoleMsgCount
     * @type Number
     * @default 0
     * @private
     */
    _consoleMsgCount : 0,

    /**
     * Date of last output log message.
     *
     * @property _lastTime
     * @type Date
     * @private
     */
    _lastTime : null,

    /**
     * Batched output timeout ID.
     *
     * @property _timeout
     * @type Number
     * @private
     */
    _timeout : null,

    /**
     * Hash of filters and their related checkbox elements.
     *
     * @property _filterCheckboxes
     * @type Object
     * @private
     */
    _filterCheckboxes : null,

    /**
     * Array of filters for log message categories.
     *
     * @property _categoryFilters
     * @type String[]
     * @private
     */
    _categoryFilters : null,

    /**
     * Array of filters for log message sources.
     *
     * @property _sourceFilters
     * @type String[]
     * @private
     */
    _sourceFilters : null,

    /**
     * LogReader container element.
     *
     * @property _elContainer
     * @type HTMLElement
     * @private
     */
    _elContainer : null,

    /**
     * LogReader header element.
     *
     * @property _elHd
     * @type HTMLElement
     * @private
     */
    _elHd : null,

    /**
     * LogReader collapse element.
     *
     * @property _elCollapse
     * @type HTMLElement
     * @private
     */
    _elCollapse : null,

    /**
     * LogReader collapse button element.
     *
     * @property _btnCollapse
     * @type HTMLElement
     * @private
     */
    _btnCollapse : null,

    /**
     * LogReader title header element.
     *
     * @property _title
     * @type HTMLElement
     * @private
     */
    _title : null,

    /**
     * LogReader console element.
     *
     * @property _elConsole
     * @type HTMLElement
     * @private
     */
    _elConsole : null,

    /**
     * LogReader footer element.
     *
     * @property _elFt
     * @type HTMLElement
     * @private
     */
    _elFt : null,

    /**
     * LogReader buttons container element.
     *
     * @property _elBtns
     * @type HTMLElement
     * @private
     */
    _elBtns : null,

    /**
     * Container element for LogReader category filter checkboxes.
     *
     * @property _elCategoryFilters
     * @type HTMLElement
     * @private
     */
    _elCategoryFilters : null,

    /**
     * Container element for LogReader source filter checkboxes.
     *
     * @property _elSourceFilters
     * @type HTMLElement
     * @private
     */
    _elSourceFilters : null,

    /**
     * LogReader pause button element.
     *
     * @property _btnPause
     * @type HTMLElement
     * @private
     */
    _btnPause : null,

    /**
     * Clear button element.
     *
     * @property _btnClear
     * @type HTMLElement
     * @private
     */
    _btnClear : null,

    /////////////////////////////////////////////////////////////////////////////
    //
    // Private methods
    //
    /////////////////////////////////////////////////////////////////////////////

    /**
     * Initializes the instance's message buffer, start time, etc
     *
     * @method _init
     * @param container {String|HTMLElement} (optional) the render target
     * @param config {Object} (optional) instance configuration
     * @protected
     */
    _init : function (container, config) {
        // Internal vars
        this._buffer = []; // output buffer
        this._filterCheckboxes = {}; // pointers to checkboxes
        this._lastTime = Logger.getStartTime(); // timestamp of last log message to console

        // Parse config vars here
        if (config && (config.constructor == Object)) {
            for(var param in config) {
                if (config.hasOwnProperty(param)) {
                    this[param] = config[param];
                }
            }
        }

        this._elContainer = Dom.get(container);

        YAHOO.log("LogReader initialized", null, this.toString());
    },

    /**
     * Initializes the primary container element.
     *
     * @method _initContainerEl
     * @private
     */
    _initContainerEl : function() {

        // Default the container if unset or not a div
        if(!this._elContainer || !/div$/i.test(this._elContainer.tagName)) {
            this._elContainer = d.body.insertBefore(make("div"),d.body.firstChild);
            // Only position absolutely if an in-DOM element is not supplied
            Dom.addClass(this._elContainer,"yui-log-container");
        }

        Dom.addClass(this._elContainer,"yui-log");

        // If implementer has provided container values, trust and set those
        var style = this._elContainer.style,
            styleProps = ['width','right','top','fontSize'],
            prop,i;

        for (i = styleProps.length - 1; i >= 0; --i) {
            prop = styleProps[i];
            if (this[prop]){ 
                style[prop] = this[prop];
            }
        }

        if(this.left) {
            style.left  = this.left;
            style.right = "auto";
        }
        if(this.bottom) {
            style.bottom = this.bottom;
            style.top    = "auto";
        }

        // Opera needs a little prodding to reflow sometimes
        if (YAHOO.env.ua.opera) {
            d.body.style += '';
        }

    },

    /**
     * Initializes the header element.
     *
     * @method _initHeaderEl
     * @private
     */
    _initHeaderEl : function() {
        // Destroy header if present
        if(this._elHd) {
            // Unhook DOM events
            Event.purgeElement(this._elHd, true);

            // Remove DOM elements
            this._elHd.innerHTML = "";
        }
        
        // Create header
        // TODO: refactor this into an innerHTML
        this._elHd = make("div",{
            id: 'yui-log-hd' + this._sName,
            className: "yui-log-hd"
        });

        this._elCollapse = make("div",{ className: 'yui-log-btns' });

        this._btnCollapse = make("input",{
            type: 'button',
            className: 'yui-log-button',
            value: 'Collapse'
        });
        Event.on(this._btnCollapse,'click',this._onClickCollapseBtn,this);


        this._title = make("h4",{ innerHTML : "Logger Console" });

        this._elCollapse.appendChild(this._btnCollapse);
        this._elHd.appendChild(this._elCollapse);
        this._elHd.appendChild(this._title);
        this._elContainer.appendChild(this._elHd);
    },

    /**
     * Initializes the console element.
     *
     * @method _initConsoleEl
     * @private
     */
    _initConsoleEl : function() {
        // Destroy console
        if(this._elConsole) {
            // Unhook DOM events
            Event.purgeElement(this._elConsole, true);

            // Remove DOM elements
            this._elConsole.innerHTML = "";
        }

        // Ceate console
        this._elConsole = make("div", { className: "yui-log-bd" });

        // If implementer has provided console, trust and set those
        if(this.height) {
            this._elConsole.style.height = this.height;
        }

        this._elContainer.appendChild(this._elConsole);
    },

    /**
     * Initializes the footer element.
     *
     * @method _initFooterEl
     * @private
     */
    _initFooterEl : function() {
        // Don't create footer elements if footer is disabled
        if(this.footerEnabled) {
            // Destroy console
            if(this._elFt) {
                // Unhook DOM events
                Event.purgeElement(this._elFt, true);

                // Remove DOM elements
                this._elFt.innerHTML = "";
            }

            // TODO: use innerHTML
            this._elFt = make("div",{ className: "yui-log-ft" });
            this._elBtns = make("div", { className: "yui-log-btns" });
            this._btnPause = make("input", {
                type: "button",
                className: "yui-log-button",
                value: "Pause"
            });

            Event.on(this._btnPause,'click',this._onClickPauseBtn,this);

            this._btnClear = make("input", {
                type: "button",
                className: "yui-log-button",
                value: "Clear"
            });

            Event.on(this._btnClear,'click',this._onClickClearBtn,this);

            this._elCategoryFilters = make("div", { className: "yui-log-categoryfilters" });
            this._elSourceFilters = make("div", { className: "yui-log-sourcefilters" });

            this._elBtns.appendChild(this._btnPause);
            this._elBtns.appendChild(this._btnClear);
            this._elFt.appendChild(this._elBtns);
            this._elFt.appendChild(this._elCategoryFilters);
            this._elFt.appendChild(this._elSourceFilters);
            this._elContainer.appendChild(this._elFt);
        }
    },

    /**
     * Initializes Drag and Drop on the header element.
     *
     * @method _initDragDrop
     * @private
     */
    _initDragDrop : function() {
        // If Drag and Drop utility is available...
        // ...and draggable is true...
        // ...then make the header draggable
        if(u.DD && this.draggable && this._elHd) {
            var ylog_dd = new u.DD(this._elContainer);
            ylog_dd.setHandleElId(this._elHd.id);
            //TODO: use class name
            this._elHd.style.cursor = "move";
        }
    },

    /**
     * Initializes category filters.
     *
     * @method _initCategories
     * @private
     */
    _initCategories : function() {
        // Initialize category filters
        this._categoryFilters = [];
        var aInitialCategories = Logger.categories;

        for(var j=0; j < aInitialCategories.length; j++) {
            var sCategory = aInitialCategories[j];

            // Add category to the internal array of filters
            this._categoryFilters.push(sCategory);

            // Add checkbox element if UI is enabled
            if(this._elCategoryFilters) {
                this._createCategoryCheckbox(sCategory);
            }
        }
    },

    /**
     * Initializes source filters.
     *
     * @method _initSources
     * @private
     */
    _initSources : function() {
        // Initialize source filters
        this._sourceFilters = [];
        var aInitialSources = Logger.sources;

        for(var j=0; j < aInitialSources.length; j++) {
            var sSource = aInitialSources[j];

            // Add source to the internal array of filters
            this._sourceFilters.push(sSource);

            // Add checkbox element if UI is enabled
            if(this._elSourceFilters) {
                this._createSourceCheckbox(sSource);
            }
        }
    },

    /**
     * Creates the UI for a category filter in the LogReader footer element.
     *
     * @method _createCategoryCheckbox
     * @param sCategory {String} Category name.
     * @private
     */
    _createCategoryCheckbox : function(sCategory) {
        if(this._elFt) {
            var filter = make("span",{ className: "yui-log-filtergrp" }),
                check  = make("input", {
                    id: "yui-log-filter-" + sCategory + this._sName,
                    className: "yui-log-filter-" + sCategory,
                    type: "checkbox",
                    category: sCategory
                }),
                label  = make("label", {
                    htmlFor: check.id,
                    className: sCategory,
                    innerHTML: sCategory
                });
            

            // Subscribe to the click event
            Event.on(check,'click',this._onCheckCategory,this);

            this._filterCheckboxes[sCategory] = check;

            // Append el at the end so IE 5.5 can set "type" attribute
            // and THEN set checked property
            filter.appendChild(check);
            filter.appendChild(label);
            this._elCategoryFilters.appendChild(filter);
            check.checked = true;
        }
    },

    /**
     * Creates a checkbox in the LogReader footer element to filter by source.
     *
     * @method _createSourceCheckbox
     * @param sSource {String} Source name.
     * @private
     */
    _createSourceCheckbox : function(sSource) {
        if(this._elFt) {
            var filter = make("span",{ className: "yui-log-filtergrp" }),
                check  = make("input", {
                    id: "yui-log-filter-" + sSource + this._sName,
                    className: "yui-log-filter-" + sSource,
                    type: "checkbox",
                    source: sSource
                }),
                label  = make("label", {
                    htmlFor: check.id,
                    className: sSource,
                    innerHTML: sSource
                });
            

            // Subscribe to the click event
            Event.on(check,'click',this._onCheckSource,this);

            this._filterCheckboxes[sSource] = check;

            // Append el at the end so IE 5.5 can set "type" attribute
            // and THEN set checked property
            filter.appendChild(check);
            filter.appendChild(label);
            this._elSourceFilters.appendChild(filter);
            check.checked = true;
        }
    },

    /**
     * Reprints all log messages in the stack through filters.
     *
     * @method _filterLogs
     * @private
     */
    _filterLogs : function() {
        // Reprint stack with new filters
        if (this._elConsole !== null) {
            this.clearConsole();
            this._printToConsole(Logger.getStack());
        }
    },

    /**
     * Sends buffer of log messages to output and clears buffer.
     *
     * @method _printBuffer
     * @private
     */
    _printBuffer : function() {
        this._timeout = null;

        if(this._elConsole !== null) {
            var thresholdMax = this.thresholdMax;
            thresholdMax = (thresholdMax && !isNaN(thresholdMax)) ? thresholdMax : 500;
            if(this._consoleMsgCount < thresholdMax) {
                var entries = [];
                for (var i=0; i<this._buffer.length; i++) {
                    entries[i] = this._buffer[i];
                }
                this._buffer = [];
                this._printToConsole(entries);
            }
            else {
                this._filterLogs();
            }
            
            if(!this.newestOnTop) {
                this._elConsole.scrollTop = this._elConsole.scrollHeight;
            }
        }
    },

    /**
     * Cycles through an array of log messages, and outputs each one to the console
     * if its category has not been filtered out.
     *
     * @method _printToConsole
     * @param aEntries {Object[]} Array of LogMsg objects to output to console.
     * @private
     */
    _printToConsole : function(aEntries) {
        // Manage the number of messages displayed in the console
        var entriesLen         = aEntries.length,
            df                 = d.createDocumentFragment(),
            msgHTML            = [],
            thresholdMin       = this.thresholdMin,
            sourceFiltersLen   = this._sourceFilters.length,
            categoryFiltersLen = this._categoryFilters.length,
            entriesStartIndex,
            i, j, msg, before;

        if(isNaN(thresholdMin) || (thresholdMin > this.thresholdMax)) {
            thresholdMin = 0;
        }
        entriesStartIndex = (entriesLen > thresholdMin) ? (entriesLen - thresholdMin) : 0;
        
        // Iterate through all log entries 
        for(i=entriesStartIndex; i<entriesLen; i++) {
            // Print only the ones that filter through
            var okToPrint = false,
                okToFilterCats = false,
                entry = aEntries[i],
                source = entry.source,
                category = entry.category;

            for(j=0; j<sourceFiltersLen; j++) {
                if(source == this._sourceFilters[j]) {
                    okToFilterCats = true;
                    break;
                }
            }
            if(okToFilterCats) {
                for(j=0; j<categoryFiltersLen; j++) {
                    if(category == this._categoryFilters[j]) {
                        okToPrint = true;
                        break;
                    }
                }
            }
            if(okToPrint) {
                // Start from 0ms elapsed time
                if (this._consoleMsgCount === 0) {
                    this._lastTime = entry.time.getTime();
                }

                msg = this.formatMsg(entry);
                if (typeof msg === 'string') {
                    msgHTML[msgHTML.length] = msg;
                } else {
                    df.insertBefore(msg, this.newestOnTop ?
                        df.firstChild || null : null);
                }
                this._consoleMsgCount++;
                this._lastTime = entry.time.getTime();
            }
        }

        if (msgHTML.length) {
            msgHTML.splice(0,0,this._elConsole.innerHTML);
            this._elConsole.innerHTML = this.newestOnTop ?
                                            msgHTML.reverse().join('') :
                                            msgHTML.join('');
        } else if (df.firstChild) {
            this._elConsole.insertBefore(df, this.newestOnTop ?
                        this._elConsole.firstChild || null : null);
        }
    },

/////////////////////////////////////////////////////////////////////////////
//
// Private event handlers
//
/////////////////////////////////////////////////////////////////////////////

    /**
     * Handles Logger's categoryCreateEvent.
     *
     * @method _onCategoryCreate
     * @param sType {String} The event.
     * @param aArgs {Object[]} Data passed from event firer.
     * @param oSelf {Object} The LogReader instance.
     * @private
     */
    _onCategoryCreate : function(sType, aArgs, oSelf) {
        var category = aArgs[0];
        
        // Add category to the internal array of filters
        oSelf._categoryFilters.push(category);

        if(oSelf._elFt) {
            oSelf._createCategoryCheckbox(category);
        }
    },

    /**
     * Handles Logger's sourceCreateEvent.
     *
     * @method _onSourceCreate
     * @param sType {String} The event.
     * @param aArgs {Object[]} Data passed from event firer.
     * @param oSelf {Object} The LogReader instance.
     * @private
     */
    _onSourceCreate : function(sType, aArgs, oSelf) {
        var source = aArgs[0];
        
        // Add source to the internal array of filters
        oSelf._sourceFilters.push(source);

        if(oSelf._elFt) {
            oSelf._createSourceCheckbox(source);
        }
    },

    /**
     * Handles check events on the category filter checkboxes.
     *
     * @method _onCheckCategory
     * @param v {HTMLEvent} The click event.
     * @param oSelf {Object} The LogReader instance.
     * @private
     */
    _onCheckCategory : function(v, oSelf) {
        var category = this.category;
        if(!this.checked) {
            oSelf.hideCategory(category);
        }
        else {
            oSelf.showCategory(category);
        }
    },

    /**
     * Handles check events on the category filter checkboxes.
     *
     * @method _onCheckSource
     * @param v {HTMLEvent} The click event.
     * @param oSelf {Object} The LogReader instance.
     * @private
     */
    _onCheckSource : function(v, oSelf) {
        var source = this.source;
        if(!this.checked) {
            oSelf.hideSource(source);
        }
        else {
            oSelf.showSource(source);
        }
    },

    /**
     * Handles click events on the collapse button.
     *
     * @method _onClickCollapseBtn
     * @param v {HTMLEvent} The click event.
     * @param oSelf {Object} The LogReader instance
     * @private
     */
    _onClickCollapseBtn : function(v, oSelf) {
        if(!oSelf.isCollapsed) {
            oSelf.collapse();
        }
        else {
            oSelf.expand();
        }
    },

    /**
     * Handles click events on the pause button.
     *
     * @method _onClickPauseBtn
     * @param v {HTMLEvent} The click event.
     * @param oSelf {Object} The LogReader instance.
     * @private
     */
    _onClickPauseBtn : function(v, oSelf) {
        if(!oSelf.isPaused) {
            oSelf.pause();
        }
        else {
            oSelf.resume();
        }
    },

    /**
     * Handles click events on the clear button.
     *
     * @method _onClickClearBtn
     * @param v {HTMLEvent} The click event.
     * @param oSelf {Object} The LogReader instance.
     * @private
     */
    _onClickClearBtn : function(v, oSelf) {
        oSelf.clearConsole();
    },

    /**
     * Handles Logger's newLogEvent.
     *
     * @method _onNewLog
     * @param sType {String} The event.
     * @param aArgs {Object[]} Data passed from event firer.
     * @param oSelf {Object} The LogReader instance.
     * @private
     */
    _onNewLog : function(sType, aArgs, oSelf) {
        var logEntry = aArgs[0];
        oSelf._buffer.push(logEntry);

        if (oSelf.logReaderEnabled === true && oSelf._timeout === null) {
            oSelf._timeout = setTimeout(function(){oSelf._printBuffer();}, oSelf.outputBuffer);
        }
    },

    /**
     * Handles Logger's resetEvent.
     *
     * @method _onReset
     * @param sType {String} The event.
     * @param aArgs {Object[]} Data passed from event firer.
     * @param oSelf {Object} The LogReader instance.
     * @private
     */
    _onReset : function(sType, aArgs, oSelf) {
        oSelf._filterLogs();
    }
};

YAHOO.widget.LogReader = LogReader;

})();
YAHOO.register("logger", YAHOO.widget.Logger, {version: "2.8.1", build: "19"});
