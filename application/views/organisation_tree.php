<style type="text/css">
  html, body {
      margin: 0px;
      padding: 0px;
      width: 100%;
      height: 100%;
      overflow: hidden;
  }

  #people {
      width: 100%;
      height: 100%;
  }

  .get-org-chart{
    background-color: #FFFFFF !important;
  }

  .get-org-chart rect.get-box {
      fill: #ffffff;
      stroke-width:3px;
      stroke: #D9D9D9;
  }

  .get-org-chart .get-text.get-text-0 {
      fill: #ffffff;
  }
  
  .get-org-chart .get-text.get-text-1 {
      fill: #ffffff;
  }
  
  .get-org-chart .get-text.get-text-2 {
      fill: #ffffff;
      font-style: italic;
      font-size: 18px;
      color: #FFF;
  }

  .get-green.get-org-chart {
      background-color: #f2f2f2;
  }
  .more-info {
      fill: #18879B;
  }

  .btn path {
      fill: #F8F8F8;
      stroke: #D9D9D9;
  }

  .btn {
      cursor: pointer;
  }
  
  .btn circle {
      fill: #555555;
  }

  .btn line {                
      stroke-width: 3px;
      stroke: #ffffff;
  }  
  .myCustomTheme-box {
    
      stroke: #DDDAB9;
  }

  .reporters {
      fill: #0072C6;
  }
  .reporters-text {
      fill: #ffffff;
  }
   
   .get-btn {
    fill: white;
    stroke-width: 2px;
    stroke: #0982d8;
    cursor: pointer
}

.get-btn-line {
    stroke-width: 2px;
    stroke: #0982d8
}  
 
</style>

<div class="page-content">
  <div class="container-fluid p-0">
	  <div class="col-lg-12 col-md-12" id="people">
    </div>
  </div>
</div>
 
<!-- <link rel="stylesheet" href="http://www.getorgchart.com/GetOrgChart/getorgchart/getorgchart.css">
<script src="http://www.getorgchart.com/GetOrgChart/getorgchart/getorgchart.js"></script> -->
<link rel="stylesheet" href="<?php echo assets_url();?>css/lib/getorgchart/getorgchart.css">
<script src="<?php echo assets_url();?>js/lib/getorgchart/getorgchart.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
      get_tree_data();
    });
  </script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
      get_tree_data();
    });

    function get_tree_data()
    {
      $.ajax({
        url: '<?php //echo site_url();?>/organisation_tree/get_tree_data',
        dataType :"json",
        type: 'POST',
        success: function(response)
        {
          console.log(response);
          getOrgChart.themes.myTheme =
          {
              size: [330, 300],
              toolbarHeight: 46,
              textPoints: [
                  { x: 70, y: 200, width: 300 },
                  { x: 70, y: 225, width: 200 },
                  { x: 70, y: 250, width: 200 }
              ],
              //textPointsNoImage: [] NOT IMPLEMENTED,
              box: '<rect x="0" y="0" height="300" width="330" rx="10" ry="10" class="get-box"></rect>',  
              text: '<text width="[width]" class="get-text get-text-[index]" x="[x]" y="[y]">[text]</text>',
              image: '<clipPath id="clip"><circle cx="160" cy="120" r="40" /></clipPath><image preserveAspectRatio="xMidYMid slice" clip-path="url(#clip)" xlink:href="[href]" x="120" y="80" height="80" width="80"/>',
              expandCollapseBtnRadius: 20
          };

          var orgchart = new getOrgChart(document.getElementById("people"),{
            theme: "myTheme",
            enableEdit: false,
            enableDetailsView: false,
            primaryFields: [ "Name", "Designation", "Email"],
            photoFields: ["Image"],
            /*updatedEvent: function () {
                init();
            },*/
            // enableExportToImage: true,
            scale: 0.5,
       	    expandToLevel : 12,
            color: "none",
	          renderNodeEvent: renderNodeEventHandler,
            dataSource: response
		      });
        }
      });
    }

	function renderNodeEventHandler(sender, args) {
    var user = "<?php //echo get_login_user_id(); ?>";
    var colors = new Array("#F0F8FF", "#FAEBD7", "#00FFFF", "#7FFFD4", "#F5F5DC", "#DEB887", "#5F9EA0", "#D2691E", "#FF7F50", "#6495ED", "#FFF8DC", "#008B8B", "#B8860B", "#A9A9A9", "#BDB76B", "#DCDCDC", "#DAA520", "#F0E68C", "#E6E6FA", "#ADD8E6");
    var id = args.node.id;
    if(id == user)
    {
      var hex = "#9370DB";
      args.content[1] = args.content[1].replace("rect", "rect style='fill: " + hex + "; stroke: " + hex + ";'");
    }
    else if(args.node.pid == null)
    {
      var hex = "#DDA0DD";
      args.content[1] = args.content[1].replace("rect", "rect style='fill: " + hex + "; stroke: " + hex + ";'");
    }
    else
    {
      args.content[1] = args.content[1].replace("rect", "rect style='fill: " + colors[args.node.data.Department] + "; stroke: " + colors[args.node.data.Department] + ";'");
    }
  }
</script> -->

<script type="text/javascript">
    function get_tree_data()
    {
    $.ajax({
        url: '<?php echo site_url();?>/organisation_tree/get_tree_data',
        dataType :"json",
        type: 'POST',
        success: function(response)
        {
            var peopleElement = document.getElementById("people");
            var orgChart = new getOrgChart(peopleElement, {
                primaryFields:  [ "Name", "Designation", "Email"],
                photoFields: ["Image"],
                expandToLevel: 2,
                 enableEdit: false,
                 enableDetailsView: false,
                //layout: getOrgChart.MIXED_HIERARCHY_RIGHT_LINKS,
                renderNodeEvent: renderNodeEventHandler,
                enableMove: true,
                dataSource: response
            });
          }
        });
  }
  function renderNodeEventHandler(sender, args) {
    var user = "<?php //echo get_login_user_id(); ?>";
    var colors = new Array("#3a6a00", "#924900", "#af3e00", "#575f00", "#755400", "#585858", "#8C0095", "#5DB2FF", "#A6006E", "#6495ED", "#D82B00", "#008B8B", "#2F4F4F", "#A9A9A9", "#BDB76B", "#DCDCDC", "#708090", "#F0E68C", "#E6E6FA", "#ADD8E6");
    var id = args.node.id;
    if(id == user)
    {
      var hex = "#9370DB";
      args.content[1] = args.content[1].replace("rect", "rect style='fill: " + hex + "; stroke: " + hex + ";'");
    }
    else if(args.node.pid == null)
    {
      var hex = "#cc3300";
      args.content[1] = args.content[1].replace("rect", "rect style='fill: " + hex + "; stroke: " + hex + ";'");
    }
    else
    {
      args.content[1] = args.content[1].replace("rect", "rect style='fill: " + colors[args.node.data.Department] + "; stroke: " + colors[args.node.data.Department] + ";'");
    }
  }
    </script>



<!-- 
 <script type="text/javascript">
     function get_tree_data()
    {
    $.ajax({
        url: '<?php //echo site_url();?>/organisation_tree/get_tree_data',
        dataType :"json",
        type: 'POST',
        success: function(response)
        {

      getOrgChart.themes.myCustomTheme =
        {
            size: [370, 350],
            toolbarHeight: 0,
            textPoints: [
                { x: 150, y: 230, width: 250 },
                { x: 150, y: 280, width: 250 }
            ],
            textPointsNoImage: [
                { x: 150, y: 230, width: 250 },
                { x: 150, y: 280, width: 250 }
            ],
            expandCollapseBtnRadius: 20,
            // defs: '<filter id="f1" x="0" y="0" width="200%" height="200%"><feOffset result="offOut" in="SourceAlpha" dx="5" dy="5" /><feGaussianBlur result="blurOut" in="offOut" stdDeviation="5" /><feBlend in="SourceGraphic" in2="blurOut" mode="normal" /></filter>',
            //box: '<rect x="0" y="0" height="400" width="270" rx="10" ry="10" class="myCustomTheme-box" filter="url(#f1)"  />',
            text: '<text text-anchor="middle" width="[width]" class="get-text get-text-[index]" x="[x]" y="[y]">[text]</text>',
            image: '<clipPath id="getMonicaClip"><circle cx="175" cy="0" r="350" /></clipPath><image preserveAspectRatio="xMidYMid slice" clip-path="url(#getMonicaClip)" xlink:href="[href]" x="50" y="0" height="350" width="350"/>',
            reporters: '<circle cx="280" cy="330" r="40" class="reporters"></circle><text class="reporters-text" text-anchor="middle" width="100" x="280" y="330">[reporters]</text>'

            //ddddd: '<text x="0" y="0">1</text>'
        };


            var peopleElement = document.getElementById("people");
            var orgChart = new getOrgChart(peopleElement, {
                theme: "myCustomTheme",
                enableGridView: true,
                primaryFields: [ "Name", "Designation", "Email"],
                photoFields: ["Image"],                
                renderNodeEvent: renderNodHandler,
                dataSource: response
            });
          }
        });
  }

            function renderNodHandler(sender, args) {
                for (var i = 0; i < args.content.length; i++) {
                    if (args.content[i].indexOf("[reporters]") != -1) {
                        args.content[i] = args.content[i].replace("[reporters]", args.node.children.length);
                    }
                }
            }

    </script> -->
