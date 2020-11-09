//	HYPE.documents["mprev_loading"]

(function(){(function m(){function k(a,b,c,d){var e=!1;null==window[a]&&(null==window[b]?(window[b]=[],window[b].push(m),a=document.getElementsByTagName("head")[0],b=document.createElement("script"),e=l,false==!0&&(e=""),b.type="text/javascript",""!=d&&(b.integrity=d,b.setAttribute("crossorigin","anonymous")),b.src=e+"/"+c,a.appendChild(b)):window[b].push(m),e=!0);return e}var l="mprev_loading.hyperesources",f="mprev_loading",g="mprevloading_hype_container";if(false==
!1)try{for(var c=document.getElementsByTagName("script"),a=0;a<c.length;a++){var d=c[a].src,b=null!=d?d.indexOf("/mprevloading_hype_generated_script.js"):-1;if(-1!=b){l=d.substr(0,b);break}}}catch(p){}c=navigator.userAgent.match(/MSIE (\d+\.\d+)/);c=parseFloat(c&&c[1])||null;d=!0==(null!=window.HYPE_648F||null!=window.HYPE_dtl_648F)||false==!0||null!=c&&10>c;a=!0==d?"HYPE-648.full.min.js":"HYPE-648.thin.min.js";c=!0==d?"F":"T";d=d?"":
"";if(false==!1&&(a=k("HYPE_648"+c,"HYPE_dtl_648"+c,a,d),false==!0&&(a=a||k("HYPE_w_648","HYPE_wdtl_648","HYPE-648.waypoints.min.js","")),false==!0&&(a=a||k("Matter","HYPE_pdtl_648","HYPE-648.physics.min.js","")),a))return;d=window.HYPE.documents;if(null!=d[f]){b=1;a=f;do f=""+a+"-"+b++;while(null!=d[f]);for(var e=document.getElementsByTagName("div"),
b=!1,a=0;a<e.length;a++)if(e[a].id==g&&null==e[a].getAttribute("HYP_dn")){var b=1,h=g;do g=""+h+"-"+b++;while(null!=document.getElementById(g));e[a].id=g;b=!0;break}if(!1==b)return}b=[];b=[];e={};h={};for(a=0;a<b.length;a++)try{h[b[a].identifier]=b[a].name,e[b[a].name]=eval("(function(){return "+b[a].source+"})();")}catch(n){window.console&&window.console.log(n),e[b[a].name]=function(){}}c=new window["HYPE_648"+c](f,g,{"1":{p:1,n:"source.gif",g:"13",t:"@1x"},"-2":{n:"blank.gif"},"-1":{n:"PIE.htc"},"0":{p:1,n:"test.svg",g:"9",t:"image/svg+xml"}},l,[],e,[{n:"Untitled Scene",o:"1",X:[0]}],
[{o:"3",p:"600px",cA:false,Y:1440,Z:600,L:[],c:"#FFF",bY:1,d:1440,U:{},T:{kTimelineDefaultIdentifier:{q:false,z:2.18,i:"kTimelineDefaultIdentifier",n:"Main Timeline",a:[{f:"c",y:0,z:0.2,i:"a",e:-10,s:-930,o:"16"},{f:"c",y:0.2,z:0.2,i:"e",e:1,s:0,o:"15"},{f:"c",y:0.2,z:1.05,i:"a",e:-10,s:-10,o:"16"},{f:"c",y:1.1,z:0.15,i:"e",e:0,s:1,o:"15"},{y:1.25,i:"e",s:0,z:0,o:"15",f:"c"},{f:"c",y:1.25,z:0.23,i:"a",e:1720,s:-10,o:"16"},{y:2.18,i:"a",s:1720,z:0,o:"16",f:"c"}],f:30,b:[]}},bZ:180,O:["16","15"],n:"Untitled Layout","_":0,v:{"15":{h:"9",p:"no-repeat",x:"visible",a:455,dB:"img",q:"100% 100%",j:"absolute",r:"inline",z:3,b:178,k:"div",d:263,c:509,e:0},"16":{h:"13",p:"no-repeat",x:"visible",tY:0.5,q:"100% 100%",b:54,a:-930,r:"inline",j:"absolute",z:2,dB:"img",d:452,k:"div",c:434,tX:0.5}}}],{},h,{},
(function (shouldShow, mainContentContainer) {
	var loadingPageID = mainContentContainer.id + "_loading";
	var loadingDiv = document.getElementById(loadingPageID);

	if(shouldShow == true) {
		if(loadingDiv == null) {	
			loadingDiv = document.createElement("div");
			loadingDiv.id = loadingPageID;
			loadingDiv.style.cssText = "overflow:hidden;position:absolute;width:150px;top:40%;left:0;right:0;margin:auto;padding:2px;border:3px solid #BBB;background-color:#EEE;border-radius:10px;text-align:center;font-family:Helvetica,Sans-Serif;font-size:13px;font-weight:700;color:#AAA;z-index:100000;";
			loadingDiv.innerHTML = "Loading";
			mainContentContainer.appendChild(loadingDiv);
		}
 
		loadingDiv.style.display = "block";
		loadingDiv.removeAttribute("aria-hidden");
		mainContentContainer.setAttribute("aria-busy", true);
	} else {
		loadingDiv.style.display = "none";
		loadingDiv.setAttribute("aria-hidden", true);
		mainContentContainer.removeAttribute("aria-busy");
	}
})

,false,true,-1,true,true,false,true,true);d[f]=c.API;document.getElementById(g).setAttribute("HYP_dn",f);c.z_o(this.body)})();})();
