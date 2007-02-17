<?php
/* SVN FILE: $Id$ */
class message_mod extends module {

   public $title = "Message Mod with MySQL";
   public $author = "Snotling";
   public $version = "0.1";

   private $messages;

   // Update actions
   public function message($line, $args)
   {
      $this->checkMessage($line['fromNick'], strtolower($line['cmd']), $line['text'], $line['to']);
   }

   private function checkMessage($user, $act, $txt, $channel)
   {
      #do the database lookup
      $found = $this->db->query("SELECT * FROM messagepending WHERE recipient='".$user."'");
      $numMessage = $this->db->numRows($found);

      if ($numMessage == 0 ) {
      } else {
         $number = $this->db->query("SELECT * FROM message WHERE seen='0' AND recipient='".$user."'");
         $num = $this->db->numRows($number);
         $this->ircClass->privMsg($channel, "$user, you have $num message(s) waiting for you.");
         $this->db->query("DELETE FROM messagepending WHERE recipient='".$user."'");
      }
   }



   //Methods here:

   public function priv_tell($line, $args)
   {
      $channel = $line['to'];
      $from = $line['fromNick'];
        if ($channel == $this->ircClass->getNick())
        {
                return;
        }

        if ($args['nargs'] == 0)
        {
           #spit out a useage
           $msg = "!tell <nick> <message>";
           $this->ircClass->privMsg($channel, $msg);
        }
        else
        {
           $nick = $args['arg1'];
           $Text = $args['query'];
           $len = strlen($nick) +1;
           $quoteText = substr($Text, $len);

           $this->db->query("INSERT INTO message (sender,recipient,mesg,seen,private) VALUES ('".$from."', '".$nick."', '".$quoteText."', '0', '0')");

           # checking to see if a message already is pending for user
           $found = $this->db->query("SELECT * FROM messagepending WHERE recipient='".$user."'");
           $numMessage = $this->db->numRows($found);
           if ($numMessage == 0 ) {
              $this->db->query("INSERT INTO messagepending (recipient) VALUES ('".$nick."')");
           }

           $this->ircClass->privMsg($channel, "I'll tell $nick next time $nick looks awake.");

        }
   }

   public function priv_msg($line, $args)
   {
      $channel = $line['to'];
      $to = $line['fromNick'];

      # check to see if other options have been added to the command
      if ($args['nargs'] > 0)
      {
          if ($args['arg1'] == "list") {
              # list the messages and numbers
              $msgs = $this->db->query("SELECT * FROM message WHERE recipient='".$to."'");
              $numMessage = $this->db->numRows($msgs);
              $this->ircClass->privMsg($channel, "Listing your messages..$numMessage found..");
              for ($x=0; $x < $numMessage; $x++) {
                  $message = $this->db->fetchArray($msgs);
                  $num = $message['id'];
                  $mess = $message['mesg'];
                  $from = $message['sender'];
                  $this->ircClass->privMsg($channel, "$num - $from - $mess");
              }

          } else if ($args['arg1'] == "del") {
              # check to make sure the next argument exists and is a number
              if ($args['arg2'] == "all") {
                 $msgs = $this->db->query("SELECT * FROM message WHERE recipient='".$to."'");
                 $numMessage = $this->db->numRows($msgs);
                 for ($x=0; $x < $numMessage; $x++) {
                    $message = $this->db->fetchArray($msgs);
                    $toDelete = $message['id'];
                    $this->db->query("DELETE FROM message WHERE recipient='".$to."' AND id='".$toDelete."' ");
                 }
                 $this->ircClass->privMsg($channel, "Deleted all messages");

              } else {
                # TODO error checking
                $toDelete = $args['arg2'];
                $this->ircClass->privMsg($channel, "Deleting message $toDelete ");
                $this->db->query("DELETE FROM message WHERE recipient='".$to."' AND id='".$toDelete."' ");
              }

          } else {
          $this->ircClass->privMsg($channel, "usage: !msg <option> - option can be either list or del # or del a
ll");
          }

      } else {
         $msgs = $this->db->query("SELECT * FROM message WHERE seen='0' AND recipient='".$to."'");
         $numMessage = $this->db->numRows($msgs);

         if ($numMessage == 0 )
         {
              $this->ircClass->privMsg($channel, "Sorry $to, there are no messages for you.");
         }
         if ($numMessage > 0 )
         {
              $message = $this->db->fetchArray($msgs);
              $num = $message['id'];
              $mess = $message['mesg'];
              $from = $message['sender'];
              $this->ircClass->privMsg($channel, "(1 of $numMessage) - $from says : $mess");

              $this->db->query("UPDATE message SET seen='1' WHERE id='".$num."'");
         }
      }
   }

}

?>