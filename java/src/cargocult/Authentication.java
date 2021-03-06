package cargocult;

import javax.crypto.*;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.SecretKeySpec;
import java.io.UnsupportedEncodingException;
import java.security.InvalidAlgorithmParameterException;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;
import java.util.Arrays;

import static cargocult.Helper.*;

public class Authentication {
  static String key = "superSecretKey";
  static IvParameterSpec initVector = new IvParameterSpec(Arrays.copyOf("pseudoRandomBits".getBytes(), 8));
  static SecretKeySpec keySpec = new SecretKeySpec(key.getBytes(), "Blowfish");
  static Cipher cipher;

  static {
    try {
    } catch (Exception e) {
      System.out.println("Exception getting cipher " + e);
    }
  }

  public static String getPrivateURL(String plainTextId) throws InvalidKeyException, BadPaddingException, IllegalBlockSizeException, InvalidAlgorithmParameterException, UnsupportedEncodingException, NoSuchPaddingException, NoSuchAlgorithmException {
    cipher = Cipher.getInstance("Blowfish/OFB/NoPadding");
    cipher.init(Cipher.ENCRYPT_MODE, keySpec, initVector);
    byte[] cipherBytes = cipher.doFinal(plainTextId.getBytes("UTF-8"));
    return bytesToHex(cipherBytes);
  }

  public static String decryptPrivateURL(String cipherTextId) throws InvalidKeyException, BadPaddingException, IllegalBlockSizeException, InvalidAlgorithmParameterException, UnsupportedEncodingException, NoSuchPaddingException, NoSuchAlgorithmException {
    cipher = Cipher.getInstance("Blowfish/OFB/NoPadding");
    cipher.init(Cipher.DECRYPT_MODE, keySpec, initVector);
    byte[] plainBytes = cipher.doFinal(hexToBytes(cipherTextId));

//    System.out.println("orig hex " + bytesToHex(plainBytes));
//    byte[] copy = Arrays.copyOf(plainBytes, plainBytes.length);
//    copy[copy.length - 1]++;
//    System.out.println("mal hex " + bytesToHex(copy));

    return new String(plainBytes, "UTF-8");
  }

  public static String getHmac(String message) throws UnsupportedEncodingException, NoSuchAlgorithmException, InvalidKeyException {
    SecretKeySpec signingKey = new SecretKeySpec(key.getBytes(), "HmacSHA1");
    Mac mac = Mac.getInstance("HmacSHA1");
    mac.init(signingKey);
    byte[] hmacBytes = mac.doFinal(message.getBytes());
    return bytesToHex(hmacBytes);
  }
}
