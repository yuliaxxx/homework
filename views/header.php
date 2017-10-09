<!DOCTYPE html>
<html lang="en">
  <head>
  	<title><?= $title ?></title>
    <meta charset="utf-8"> 
  	<style>
  		html {width:100%;height:100%;}
  		body {margin:0;width:100%;height:100%;background-image: url(sky.jpg);background-size: 100% 100%;  min-width:74%;}
  		h1 {position:absolute; top: 0%; margin-left:0%;}
  		.table1 { position:absolute; width:60%; height:95%;	top: 2%; margin-left:25%; background:rgba(0,0,0,.5);
      box-shadow: 4px 4px 8px rgba(0,0,0,.5);}
  		.table2 {position:absolute; width:97%; height:80%;	top: 3%; margin-left:1%;}
  		caption{color:white; font-size: 12pt;}
  		.new{color:white; font-size: 20pt;}
  		p {color:white; font-size: 16pt;}
      .main{position:absolute; margin-left:5%; top:3%;}
      .c {
    		border: 1px solid #333; 
    		display: inline-block;
    		padding: 5px 15px; 
    		text-decoration: none; 
    		color: #000; 
  		}
   		.c:hover {
    		box-shadow: 0 0 5px rgba(0,0,0,0.3); 
    		background: #B0C4DE; 
    		color: #000;
   		}
      .button1{background-color:#6495ED;}
      .right{position:absolute; margin-left:80%; top:0%;}
      
      .left {position:absolute; margin-left:5%; top:0%;}
      .radio{font-size:14pt;}
  		.addbutton
      {
        text-align: center;
        vertical-align:middle;
        font-size: 13px;
        width: 100px;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 1%;
        margin-left: 1%;
        color: #FFFFFF;
        background-color:#6495ED;
       } 	
  		.table3 {
    		position:absolute;
    		margin-left:5%;
    		top: 20%;
   		 	width:90%;
  			font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        color: #000;
      }
			.th1 {
  			border-bottom: 3px  #B9B29F;
  			
  			text-align: left;
			}
			.td1 {
  			padding: 10px;
			}
			.tr1:nth-child(odd) {
  			background: white;
			}
			.tr1:nth-child(even) {
 			 	background: #B0C4DE;
			}
    
    	.abutton {
        display: inline-block;
  			text-decoration: none;
  			background: #B0C4DE;
  			padding: 1em;
  			outline: none;
  			border-radius: 1px;
			}
			.abutton:hover {
  			background-image:
   			radial-gradient(1px 45% at 0% 50%, rgba(0,0,0,.6), transparent),
        radial-gradient(1px 45% at 100% 50%, rgba(0,0,0,.6), transparent);
      }
    </style>
    
	</head>
  <body>