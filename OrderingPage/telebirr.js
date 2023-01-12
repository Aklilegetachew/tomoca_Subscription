const tbBtn = document.querySelector("#btn-tb");
// const appKey = "daee4785f9f44cd7be28ed92094a3411";
// const appId = "ce83aaa3dedd42ab88bd017ce1ca2dd8";

// let signObj = {
//   appId: "ce83aaa3dedd42ab88bd017ce1ca2dd8",
//   nonce: "df2614e624414020b9062f9512cd55d9",
//   notifyUrl: "http://localhost/notifyUrl",
//   outTradeNo: "202110181634541567060",
//   receiveName: "Org Name",
//   returnUrl: "http://localhost/returnUrl",
//   shortCode: "10011",
//   subject: "Goods Name",
//   timeoutExpress: "30",
//   timestamp: "1634541567060",
//   totalAmount: "10",
// };
// signObj.appKey = appKey;
// let StringA = jsonSort(signObj);

// function jsonSort(jsonObj) {
//   let arr = [];
//   for (var key in jsonObj) {
//     arr.push(key);
//   }
//   arr.sort();
//   let str = "";
//   for (var i in arr) {
//     str += arr[i] + "=" + jsonObj[arr[i]] + "&";
//   }
//   return str.substring(0, str.length - 1);
// }

// function sha256(data) {
//   var hash = crypto.createHash("sha256");
//   hash.update(data);
//   return hash.digest("hex");
// }

// let StringB = sha256(StringA);

// let sign = strings.ToUpper(StringB);
// let jsonObj = {
//   appId: "ce83aaa3dedd42ab88bd017ce1ca2dd8",
//   nonce: "df2614e624414020b9062f9512cd55d9",
//   notifyUrl: "http://localhost/notifyUrl",
//   outTradeNo: "202110181634541567060",
//   receiveName: "Org Name",
//   returnUrl: "http://localhost/returnUrl",
//   shortCode: "10011",
//   subject: "Goods Name",
//   timeoutExpress: "30",
//   timestamp: "1634541567060",
//   totalAmount: "10",
// };
// let ussdjson = JSON.stringify(jsonObj);

// let ussd = rsa_encrypt(ussdjson);

// const rsa_encrypt = (data) => {
//   let key = new NodeRSA(getPublicKey(publicKey));
//   key.setOptions({ encryptionScheme: "pkcs1" });
//   let encryptKey = key.encrypt(data, "base64");
//   return encryptKey;
// };

// function insertStr(str, insertStr, sn) {
//   var newstr = "";
//   for (var i = 0; i < str.length; i += sn) {
//     var tmp = str.substring(i, i + sn);
//     newstr += tmp + insertStr;
//   }
//   return newstr;
// }

// const getPublicKey = function (key) {
//   const result = insertStr(key, "\n", 64);
//   return "-----BEGIN PUBLIC KEY-----\n" + result + "-----END PUBLIC KEY-----";
// };

// let requestMessage = { appid: signObj.appId, sign: sign, ussd: ussd };

// const uri = "http://196.188.120.3:11443/ammapi/service-openup/toTradeWebPay/";

// tbBtn.addEventListener("click", makeRequest);

// async function makeRequest() {
//   //   await axios
//   //     .post(uri, requestMessage)
//   //     .then((res) => {
//   //       if (res.status == 200 && res.data.code == 200) {
//   //         rsp.redirect(res.data.data.toPayUrl);
//   //       } else {
//   //         console.error(res.data.message);
//   //       }
//   //     })
//   //     .catch((error) => {
//   //       console.error(error);
//   //     });

//   console.log("hello log man ");
// }

function test(_data) {
  // $.ajax({
  //   url: "http://196.188.120.3:11443/ammapi/service-openup/toTradeWebPay/",
  //   success: function (result) {
  //     alert("hello again");
  //   },
  // });
  try {
    fetch("https://196.188.120.3:11443/ammapi/service-openup/toTradeWebPay/", {
      method: "POST",
      body: JSON.stringify(_data),
      headers: { "Content-type": "application/json; charset=UTF-8" },
    })
      .then((response) => response.json())
      .then((json) => console.log(json));
  } catch (err) {
    console.log(err);
  }

  alert("hello again");
}
