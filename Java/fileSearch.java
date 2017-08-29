package fileSearch;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFileChooser;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.border.EmptyBorder;
import javax.swing.text.BadLocationException;
import javax.swing.text.Document;
import javax.swing.text.SimpleAttributeSet;
import javax.swing.text.StyleConstants;
import javax.swing.JLabel;
import java.awt.GridLayout;
import javax.swing.JButton;
import javax.swing.SwingConstants;
import javax.swing.UIManager;
import javax.swing.UnsupportedLookAndFeelException;

import java.awt.Color;
import javax.swing.JTextField;
import javax.swing.JEditorPane;
import javax.swing.JSlider;
import java.awt.event.ActionListener;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Set;
import java.awt.event.ActionEvent;
import javax.swing.JTextPane;
import javax.swing.JFormattedTextField;
import javax.swing.JComboBox;

public class fileSearch extends JFrame{
	private JPanel contentPane;
	private static JFileChooser selectDirectoryFileChooser = new JFileChooser(System.getProperty("user.home") + "/Desktop");
	private static JFileChooser outputFileChooser = new JFileChooser(System.getProperty("user.home") + "/Desktop");
	private JTextField selectDirectoryTextbox;
	private JLabel selectDirectoryLbl;
	private File searchDirectory;
	private File outputFile;
	private JTextField searchTextTextbox;
	private JTextField outputFileTextbox;
	private JButton submitBtn;
	private JTextPane outputTextPane;
	private Document doc;
	private SimpleAttributeSet set;
	/**
	 * Launch the application.
	 * @throws UnsupportedLookAndFeelException 
	 * @throws IllegalAccessException 
	 * @throws InstantiationException 
	 * @throws ClassNotFoundException 
	 */
	public static void main(String[] args) throws ClassNotFoundException, InstantiationException, IllegalAccessException, UnsupportedLookAndFeelException {
		UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					fileSearch frame = new fileSearch();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}
	public fileSearch(){
		this.setTitle("File Search");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(500, 150, 400, 400);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(0, 0, 0, 0));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		this.setResizable(false);
		selectDirectoryFileChooser.setFileSelectionMode(JFileChooser.FILES_AND_DIRECTORIES);
		
		selectDirectoryTextbox = new JTextField();
		selectDirectoryTextbox.setEditable(false);
		selectDirectoryTextbox.setForeground(Color.BLACK);
		selectDirectoryTextbox.setBackground(Color.LIGHT_GRAY);
		selectDirectoryTextbox.setBounds(74, 24, 160, 22);
		contentPane.add(selectDirectoryTextbox);
		selectDirectoryTextbox.setColumns(20);
		
		JButton selectDirectoryBtn = new JButton("Browse...");
		selectDirectoryBtn.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e){
				int response = selectDirectoryFileChooser.showOpenDialog(fileSearch.this);
				if(response == JFileChooser.APPROVE_OPTION){
					searchDirectory = selectDirectoryFileChooser.getSelectedFile();
					selectDirectoryTextbox.setText(selectDirectoryFileChooser.getSelectedFile().toString());
				}
			}
		});
		selectDirectoryBtn.setBounds(234, 23, 92, 24);
		contentPane.add(selectDirectoryBtn);
		
		selectDirectoryLbl = new JLabel("Please choose a directory to search:");
		selectDirectoryLbl.setHorizontalAlignment(SwingConstants.LEFT);
		selectDirectoryLbl.setBounds(74, 0, 200, 24);
		contentPane.add(selectDirectoryLbl);
		
		searchTextTextbox = new JTextField();
		searchTextTextbox.setBounds(74, 70, 252, 22);
		contentPane.add(searchTextTextbox);
		searchTextTextbox.setColumns(10);
		
		JLabel searchTextLbl = new JLabel("Search files for text:");
		searchTextLbl.setHorizontalAlignment(SwingConstants.LEFT);
		searchTextLbl.setBounds(74, 46, 140, 24);
		contentPane.add(searchTextLbl);
		
		JButton outputFileBtn = new JButton("Browse...");
		outputFileBtn.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e){
				int response = outputFileChooser.showOpenDialog(fileSearch.this);
				if(response == JFileChooser.APPROVE_OPTION){
					outputFile = outputFileChooser.getSelectedFile();
					outputFileTextbox.setText(outputFileChooser.getSelectedFile().toString());
				}
			}
		});
		outputFileBtn.setBounds(234, 115, 92, 24);
		contentPane.add(outputFileBtn);
		
		outputFileTextbox = new JTextField();
		outputFileTextbox.setForeground(Color.BLACK);
		outputFileTextbox.setEditable(false);
		outputFileTextbox.setColumns(20);
		outputFileTextbox.setBackground(Color.LIGHT_GRAY);
		outputFileTextbox.setBounds(74, 116, 160, 22);
		contentPane.add(outputFileTextbox);
		
		JLabel outputFileLbl = new JLabel("Specify output file location(Optional):");
		outputFileLbl.setHorizontalAlignment(SwingConstants.LEFT);
		outputFileLbl.setBounds(74, 92, 200, 24);
		contentPane.add(outputFileLbl);
		
		submitBtn = new JButton("Search");
		submitBtn.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				submitResponse();
			}
		});
		submitBtn.setBounds(154, 336, 92, 24);
		contentPane.add(submitBtn);
		
		JScrollPane outputScrollPane = new JScrollPane();
		outputScrollPane.setBounds(22, 146, 350, 185);
		contentPane.add(outputScrollPane);
		
		outputTextPane = new JTextPane();
		outputScrollPane.setViewportView(outputTextPane);
		
		set = new SimpleAttributeSet();
		doc = outputTextPane.getStyledDocument();
		outputTextPane.setCharacterAttributes(set, true);
	}
	public void submitResponse(){
		outputTextPane.setText("");
		if(!(searchDirectory == null) && !(searchTextTextbox.getText().equals(""))){
			if(!(outputFile == null)){
				try{FileWriter fw = new FileWriter(outputFile,false);
					BufferedWriter bw = new BufferedWriter(fw);
					PrintWriter pw = new PrintWriter(bw);
					pw.flush();
					recursiveDirectorySearch(searchDirectory, searchTextTextbox.getText(), pw);
					fw.close();bw.close();pw.close();
				}catch(IOException e){}
			}
			else{
				recursiveDirectorySearch(searchDirectory, searchTextTextbox.getText(), null);
			}
		}
	}
	public void recursiveDirectorySearch(File rootDirectory, String searchString, PrintWriter pw){
		if(rootDirectory.isDirectory()){
			File files[] = rootDirectory.listFiles();
			for (int i = 0; i < files.length; i++) {
				searchAndWriteFile(files[i],searchString,pw);
				if(files[i].isDirectory()){
					recursiveDirectorySearch(files[i],searchString,pw);
				}
			}
		}else if(rootDirectory.isFile()){
			searchAndWriteFile(rootDirectory, searchString, pw);
		}
	}
	public void searchAndWriteFile(File searchFile, String searchString, PrintWriter pw){
			if(searchFile.equals(outputFile)){
				System.out.println("they match");
				return;
			}
		try{FileReader fr = new FileReader(searchFile);
			BufferedReader br = new BufferedReader(fr);
			String line = "";
			int counter = 0;
			boolean found = false;
			while((line = br.readLine()) != null){
				counter ++;
				for(int i = 0; i < line.length(); i++){
					if(line.charAt(i) == searchString.charAt(0)){
						for(int j = 0; j < searchString.length(); j++){
							if(((i+j)<line.length()) && (line.charAt(i+j) == searchString.charAt(j))){	
								found = true;
							}else{
								found = false;
								break;
							}
						}
						if(found == true){
							if(!(pw == null)){
								pw.println(searchFile + ":" +counter);
								pw.println(line);
								pw.flush();
							}
							try{doc.insertString(doc.getLength(), searchFile + ":" + counter, set);}catch(BadLocationException e){}
							try{doc.insertString(doc.getLength(),"\n" + line + "\n", set);}catch(BadLocationException e){}
						}
					}
				}
			}
			fr.close();br.close();
		}catch(IOException e){}
	}
}