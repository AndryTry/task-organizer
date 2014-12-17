package lj.project.taskorganizer;

import android.app.Activity;
import android.os.Bundle;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class MainActivity extends Activity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		WebView myWebView = (WebView) findViewById(R.id.webview);
		myWebView.setWebViewClient(new WebViewClient());
		myWebView.getSettings().setJavaScriptEnabled(true);
		//alamat host, pada android emulator umumnya digunakan 10.0.2.2
		//bisa juga menggunakan ip statis dari komputer jika akan debug dari device android
		myWebView.loadUrl("http://10.0.2.2/TaskOrganizer/list.php");
	}
}
