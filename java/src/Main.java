import cargocult.Authentication;

import javax.crypto.BadPaddingException;
import javax.crypto.IllegalBlockSizeException;
import javax.crypto.NoSuchPaddingException;
import java.io.UnsupportedEncodingException;
import java.security.InvalidAlgorithmParameterException;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;

public class Main {
  public static void main(String[] args) throws BadPaddingException, InvalidKeyException, IllegalBlockSizeException, InvalidAlgorithmParameterException, UnsupportedEncodingException, NoSuchAlgorithmException, NoSuchPaddingException {
    System.out.println("Cargo Cult Security\n");

    String plainTextId = "100000";
    String cipherTextId = Authentication.getPrivateURL(plainTextId);
    System.out.println("Private URL param: " + cipherTextId + "\n");

    plainTextId = Authentication.decryptPrivateURL(cipherTextId);
    System.out.println("Decrypted ID: " + plainTextId + "\n");

    String maliciousCipherTextId = "3C2A754D0985";
    System.out.println("Malicious cipher text ID: " + maliciousCipherTextId);
    String maliciousPlainTextId = Authentication.decryptPrivateURL(maliciousCipherTextId);
    System.out.println("Decrypted malicious ID: " + maliciousPlainTextId + "\n");

    String hmac = Authentication.getHmac("important message");
    System.out.println("HMAC: " + hmac + "\n");

    String userID = "834";
    cipherTextId = Authentication.getPrivateURL(userID);
    System.out.println("Private URL param for user ID " + userID + " : " + cipherTextId + "\n");
  }
}
