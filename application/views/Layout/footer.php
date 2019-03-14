
<div class="fotter"></div>
<script type="text/javascript">
			$("input").keypress(function(e) {
				if(e.which == 13) {
					$(".btn-search").click();
				}
			});

			$("select").keypress(function(e) {
				if(e.which == 13) {
					$(".btn-search").click();
				}
			});
			function calTime(from, to) {
				if (from == ":00" || to == ":00") return "";
				var TimeFrom = new Date("5/11/2005 " + from);
				var TimeTo = new Date ("5/11/2005 " + to);
				var result = "";

				fromMinute = TimeFrom.getMinutes();
				toMinute = TimeTo.getMinutes();
				fromHour = TimeFrom.getHours();
				toHour = TimeTo.getHours();

				if (from > to) {
					toHour += 24;
				}

				if (fromMinute > toMinute) {
					toMinute += 60;
					toHour -= 1;
				}

				result = (toHour - fromHour) + ":" + (toMinute - fromMinute);

				return result;
			}
			function checkKeyPress(length, e) {
				if ( e.which != 13 && e.key != "Tab" && e.key != "Backspace") {
					if (length >= 5) return false;
					if (e.key != ":" && (e.charCode < 48 || e.charCode > 58)) return false;
				}
				return true;
			}
			function checkChange(value) {
				if (/^(2[0-3]|[0-1]?[0-9])(:([0-5]?[0-9])?)?$/.test(value) == false) {
					alert("Time must be the formated as [HH:MM]");
					return false;
				}
				 return true;
			}
			function reFormat(value) {
				var splited = value.split(":");
				var result = "00";
				if (splited[0] != "") {
					result = splited[0].length > 1? splited[0] : "0" + splited[0];
				}
				result += ":";
				if (splited.length == 2 && splited[1] != "" ) {
					result += splited[1].length > 1? splited[1] : "0" + splited[1];
				} else {
					result += "00";
				}

				return result;
			} 
		</script>
</body>
</html>