import { library, dom } from '@fortawesome/fontawesome-svg-core'
import { faAddressCard, faClock } from '@fortawesome/free-regular-svg-icons'
import { faSearch, faStoreAlt, faShoppingBag, faSignOutAlt, faYenSign, faCamera } from '@fortawesome/free-solid-svg-icons'
import { faTwitter } from '@fortawesome/free-brands-svg-icons'

library.add(faSearch, faAddressCard, faStoreAlt, faShoppingBag, faSignOutAlt, faYenSign, faClock, faCamera, faTwitter);
  
 dom.watch();

 document.querySelector('.js-image-picker input')
       .addEventListener('change', (e) => {
           const input = e.target;
           const reader = new FileReader(); //FileReaderクラスのインスタンスを作成
           reader.onload = (e) => {
            // 以下から、画像を読み込んだ後の処理を記述する
                // クラス属性js-image-pickerを指定
               input.closest('.js-image-picker').querySelector('img').src = e.target.result
           };
// 第一引数にFileクラスのオブジェクトを指定する。ここではinputタグのDOMのfilesフィールドに格納されている、Fileオブジェクトを指定してる。
           reader.readAsDataURL(input.files[0]); 
       });