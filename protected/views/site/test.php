<script type="text/javascript">
	var colorify=function(e){var t=(e.id||1,e.container||"colorify"),r=e.images||!1,a=e.accuracy||100,n=e.lazyReveal||!1,i=e.gradient||!1,l=e.gradientDirection||"to bottom right",o=e.padding||4,c=e.give||!1,s=e.revealOn||!1;if(0==!n)var d=e.lazyReveal.transition||0,g=e.lazyReveal.delay||0,u=e.lazyReveal.steps||!1;if(0==!s)var v=e.revealOn.event||!1,y=e.revealOn.trigger||!1;if(0==!c)var b=e.give.property||!1,m=e.give.target||!1;for(var f=document.querySelectorAll("["+t+"]"),p=0,h=f.length;h>p;p++)var A=e.attr||t+"-"+p;if(0==!r)for(var p=0,h=r.length;h>p;p++)for(var p=([r[p]],0);h>p;p++){var S=document.createElement("img");S.setAttribute(A,""),S.crossOrigin="Anonymous",S.src=r[p];var L=document.createElement("div");L.classList.add("image-container"),L.setAttribute("style","padding: "+o+"px;"),0==!s&&(L.style.opacity="0",L.classList.add("to-reveal")),L.appendChild(S),document.querySelector("["+t+"]").appendChild(L)}for(var q=document.querySelectorAll("["+t+"] img"),p=0,h=q.length;h>p;p++)q[p].setAttribute(A,""),q[p].classList.add("colorify");for(var E=document.querySelectorAll("["+A+"]"),C=E.length,I=0,p=0,h=E.length;h>p;p++){E[p].setAttribute(A,""),E.crossOrigin="Anonymous",E.src=E[p];var L=document.createElement("div");L.classList.add("image-container"),L.setAttribute("style","padding: "+o+"px;"),0==!s&&(L.style.opacity="0",L.classList.add("to-reveal")),L.appendChild(E[p]);var N=document.querySelector("["+t+"]");N.appendChild(L)}if(0==!s){var O=document.querySelectorAll(".to-reveal");document.querySelector(y).addEventListener(v,function(){for(var e=0,t=O.length;t>e;e++)O[e].style.opacity="1"})}setTimeout(function(){function e(e,t){var a=r(e);if(i){var n="rgb("+a[0].r+","+a[0].g+","+a[0].b+"), rgb("+a[1].r+","+a[1].g+","+a[1].b+")";e.parentNode.style.backgroundImage="linear-gradient("+l+","+n+") "}else e.parentNode.style.backgroundColor="rgb("+a[0].r+","+a[0].g+","+a[0].b+")";if(0==!c){var o=m.substring(0,1);if("#"==o||"."==o||"*"==o||"["==o)for(var s=document.querySelectorAll(m),v=0,y=s.length;y>v;v++)s[v].setAttribute("style",b+": rgb("+a[0].r+","+a[0].g+","+a[0].b+")");"parent"==m&&e.parentNode.parentNode.setAttribute("style",b+": rgb("+a[0].r+","+a[0].g+","+a[0].b+") !important"),"child"==m&&e.childNode.setAttribute("style",b+": rgb("+a[0].r+","+a[0].g+","+a[0].b+") !important")}(0==!d&&0==!g||0==!d||0==!g)&&(1==u?e.setAttribute("style","transition: all "+d+"s ease "+g*t+"s;"):e.setAttribute("style","transition: all "+d+"s ease "+g+"s;")),e.classList.add("visible","all-not-loaded"),I>=C&&(e.classList.remove("all-not-loaded"),e.classList.add("all-loaded"))}function t(e,t){var r={r:0,g:0,b:0},a=e.data.length,n=0,i=-4;t=t||{},t.accuracy=t.accuracy||1;for(var l=t.accuracy;(i+=4*l)<a;)++n,r.r+=e.data[i],r.g+=e.data[i+1],r.b+=e.data[i+2];return r.r=~~(r.r/n),r.g=~~(r.g/n),r.b=~~(r.b/n),r}function r(e){var r,n,l={r:0,g:0,b:0},o=document.createElement("canvas"),c=o.getContext&&o.getContext("2d"),s={r:0,g:0,b:0};if(!c)return l;if(n=o.height=e.naturalHeight||e.offsetHeight||e.height,r=o.width=e.naturalWidth||e.offsetWidth||e.width,c.drawImage(e,0,0),i){try{rgbStart=t(c.getImageData(0,0,r/4,n/4),{accuracy:a}),rgbEnd=t(c.getImageData(r-r/4,n-n/4,r/4,n/4),{accuracy:a})}catch(d){console.log("image cannot be processed",d),rgbStart=l,rgbEnd=l}return[rgbStart,rgbEnd]}try{s=t(c.getImageData(0,0,r,n),{accuracy:a})}catch(d){console.log("image cannot be processed",d),s=l}return[s]}for(p=0;C>p;p++)I++,E[p].onload=e(E[p],I)})};
</script>

<style type="text/css">
	/* Required */
	img.colorify:not(.visible) {
	  opacity: 0;
	  filter: blur(3px);
	}

	img.colorify:not(.all-loaded).all-not-loaded {
	  image-rendering: -moz-crisp-edges;
	  image-rendering: -o-crisp-edges;
	  image-rendering: -webkit-optimize-contrast;
	  -ms-interpolation-mode: nearest-neighbor;
	  image-rendering: pixelated;
	}
</style>



<div colorify-main-color>
	<img colorify src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/place.jpg" width="30%" />
	<img colorify src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/xk.png" width="30%">
	<img colorify src="<?php echo Yii::app()->request->baseUrl; ?>/vstyle/imgs/iwantplay_btn.png" width="30%">
</div>

<script type="text/javascript">
	colorify({
	    container: 'colorify-main-color',
	    lazyReveal: {
	      transition: 2,  // The transition occurs for 2 seconds
	      delay: 1,
	      steps: true
	    }
	  });
</script>