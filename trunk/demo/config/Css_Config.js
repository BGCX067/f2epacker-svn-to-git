{
    "Version":"v3",
	"Update":"20091015",
	"Compress":"4",
	"Common":{
		"comm1":["common/global.css"],
		"comm2":["common/global2.css"]
	},
	"Domain":{
		"d1":["http://home.sh.liba.com/a.css"]
	},
	"Module":{ 
	       "m1":["module/service.css"]
	},
	"Page":{
	       "index_php":{
	       		"C":["comm1"],
	       		"M":[],
	       		"D":[],
	       		"P":["sys/index.css"]
	       },
		   "search_php":{
	       		"C":["comm1"],
	       		"M":[],
	       		"D":[],
	       		"P":["product/search.css","product/general.css"]
	       }
	 }
}